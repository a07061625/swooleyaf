<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 10:56
 */
namespace Wx;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use Tool\Tool;
use Traits\SimpleTrait;

final class WxUtilShop extends WxUtilBaseAlone
{
    use SimpleTrait;

    /**
     * 生成签名
     * @param array $data
     * @param string $appId
     * @param string $signType
     * @return string
     */
    public static function createSign(array $data, string $appId, string $signType = 'md5')
    {
        //签名步骤一：按字典序排序参数
        ksort($data);
        //签名步骤二：格式化后加入KEY
        $needStr1 = '';
        foreach ($data as $key => $value) {
            if ($key == 'sign') {
                continue;
            }
            if ((!is_string($value)) && !is_numeric($value)) {
                continue;
            }
            if (strlen($value) == 0) {
                continue;
            }
            $needStr1 .= $key . '=' . $value . '&';
        }

        $payKey = WxConfigSingleton::getInstance()->getShopConfig($appId)->getPayKey();
        $needStr1 .= 'key=' . $payKey;
        //签名步骤三：加密
        if ($signType == 'md5') {
            $needStr2 = md5($needStr1);
        } else {
            $needStr2 = hash_hmac('sha256', $needStr1, $payKey);
        }
        //签名步骤四：所有字符转为大写
        return strtoupper($needStr2);
    }

    /**
     * 校验数据签名合法性
     * @param array $data 待校验数据
     * @param string $appId
     * @return bool
     */
    public static function checkSign(array $data, string $appId) : bool
    {
        if (isset($data['sign']) && is_string($data['sign'])) {
            $nowSign = self::createSign($data, $appId);
            return $nowSign === $data['sign'];
        }

        return false;
    }

    /**
     * 处理退款通知消息
     * @param array $data
     * @return array
     */
    public static function handleRefundNotify(array $data) : array
    {
        $resArr = [
            'code' => 0
        ];

        if ($data['return_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $data['return_msg'];
            return $resArr;
        }

        $decryptData = base64_decode($data['req_info'], true);
        if (is_bool($decryptData)) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = '解密数据失败';
            return $resArr;
        }

        $password = md5(WxConfigSingleton::getInstance()->getShopConfig($data['appid'])->getPayKey());
        $decryptMsg = openssl_decrypt($decryptData, 'aes-256-ecb', $password, OPENSSL_RAW_DATA);
        $refundData = Tool::xmlToArray($decryptMsg);
        if (isset($refundData['refund_id'])) {
            $resArr['data'] = $refundData;
            $resArr['data']['appid'] = $data['appid'];
            $resArr['data']['mch_id'] = $data['mch_id'];
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = '解密数据出错';
        }

        return $resArr;
    }

    /**
     * 企业银行付款rsa加密
     * @param string $appId
     * @param array $data
     * @return array
     * @throws \SyException\Wx\WxException
     */
    public static function encryptRsaCompanyBank(string $appId, array $data) : array
    {
        if (empty($data)) {
            throw new WxException('加密数据不能为空', ErrorCode::WX_POST_ERROR);
        }

        $keyContent = WxConfigSingleton::getInstance()->getShopConfig($appId)->getSslCompanyBank();
        if (strlen($keyContent) == 0) {
            throw new WxException('银行卡公钥不能为空', ErrorCode::WX_POST_ERROR);
        }

        $publicKey = openssl_pkey_get_public($keyContent);
        $encryptData = [];
        foreach ($data as $key => $val) {
            if (is_string($val) && (strlen($val) > 0)) {
                $encryptStr = '';
                openssl_public_encrypt($val, $encryptStr, $publicKey, OPENSSL_PKCS1_OAEP_PADDING);
                $encryptData[$key] = $encryptStr;
            }
        }
        openssl_free_key($publicKey);

        return $encryptData;
    }
}
