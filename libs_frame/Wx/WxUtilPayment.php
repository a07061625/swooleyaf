<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/4 0004
 * Time: 13:59
 */

namespace Wx;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class WxUtilPayment
 *
 * @package Wx
 */
abstract class WxUtilPayment extends WxUtilBase
{
    use SimpleTrait;

    /**
     * 处理退款通知消息
     */
    public static function handleRefundNotify(array $data): array
    {
        $resArr = [
            'code' => 0,
        ];

        if ('FAIL' == $data['return_code']) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $data['return_msg'];

            return $resArr;
        }

        $decryptData = base64_decode($data['req_info'], true);
        if (\is_bool($decryptData)) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = '解密数据失败';

            return $resArr;
        }

        $password = md5(WxConfigSingleton::getInstance()->getAccountConfig($data['appid'])->getPayKey());
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
     *
     * @throws \SyException\Wx\WxException
     */
    public static function encryptRsaCompanyBank(string $appId, array $data): array
    {
        if (empty($data)) {
            throw new WxException('加密数据不能为空', ErrorCode::WX_POST_ERROR);
        }

        $keyContent = WxConfigSingleton::getInstance()->getAccountConfig($appId)->getSslCompanyBank();
        if (0 == \strlen($keyContent)) {
            throw new WxException('银行卡公钥不能为空', ErrorCode::WX_POST_ERROR);
        }

        $publicKey = openssl_pkey_get_public($keyContent);
        $encryptData = [];
        foreach ($data as $key => $val) {
            if (\is_string($val) && (\strlen($val) > 0)) {
                $encryptStr = '';
                openssl_public_encrypt($val, $encryptStr, $publicKey, OPENSSL_PKCS1_OAEP_PADDING);
                $encryptData[$key] = $encryptStr;
            }
        }
        openssl_free_key($publicKey);

        return $encryptData;
    }

    /**
     * 获取H5支付深度链接
     */
    public static function getH5PayDeepLink(array $data): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $data['mweb_url']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-FORWARDED-FOR: ' . $data['client_ip'],
            'CLIENT-IP: ' . $data['client_ip'],
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, $data['refer_url']);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; Android 6.0.1; OPPO R11s Build/MMB29M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/55.0.2883.91 Mobile Safari/537.36');
        $execRes = curl_exec($ch);
        curl_close($ch);

        $matches = [];
        preg_match('/var\surl="(.*)"/', $execRes, $matches);

        if (empty($matches)) {
            return '';
        }
        $deepLinkUrl = urldecode($matches[1]);
        if (isset($data['redirect_url'])) {
            $deepLinkUrl .= '&redirect_url=' . urlencode($data['redirect_url']);
        }

        return $deepLinkUrl;
    }

    /**
     * 生成V3请求头认证令牌
     * 支付深度链接,参考连接: https://www.cnblogs.com/txw1958/p/wxpayv3_h5.html
     */
    public static function createV3Token(array $data): string
    {
        $urlInfo = parse_url($data['request_url']);
        $message = $data['request_method'] . "\n" . $urlInfo['path'];
        if (!empty($urlInfo['query'])) {
            $message .= '?' . $urlInfo['query'];
        }
        $message .= "\n" . $data['timestamp'] . "\n" . $data['nonce'] . "\n" . $data['body'] . "\n";
        openssl_sign($message, $rawSign, $data['mch_private_key'], 'sha256WithRSAEncryption');
        $sign = base64_encode($rawSign);

        return 'mchid="' . $data['merchant_id']
               . '",nonce_str="' . $data['nonce']
               . '",timestamp="' . $data['timestamp']
               . '",serial_no="' . $data['serial_no']
               . '",signature="' . $sign . '"';
    }

    /**
     * v3加密,要求PHP7.1+
     *
     * @param string $clearText 明文
     * @param string $publicKey 公钥文件内容,可能是api或者平台的公钥证书内容
     *
     * @throws \SyException\Wx\WxException
     */
    public static function v3Encrypt(string $clearText, string $publicKey): string
    {
        $cipherText = '';
        if (openssl_public_encrypt($clearText, $cipherText, $publicKey, OPENSSL_PKCS1_OAEP_PADDING)) {
            return base64_encode($cipherText);
        }

        throw new WxException('V3加密失败', ErrorCode::WX_PARAM_ERROR);
    }

    /**
     * v3解密,要求PHP7.1+
     * 注: 后面两个参数相关内容可参考接口 https://api.mch.weixin.qq.com/v3/certificates的返回数据
     *
     * @param string $sign           加密后的密文
     * @param string $aesKey         V3密钥
     * @param string $associatedData 证书associated_data
     * @param string $nonce          证书随机字符串
     *
     * @return bool|string
     *
     * @throws \SyException\Wx\WxException
     */
    public static function v3Decrypt(string $sign, string $aesKey, string $associatedData, string $nonce)
    {
        if (32 != \strlen($aesKey)) {
            throw new WxException('V3密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $cipherText = base64_decode($sign, true);
        if (\strlen($cipherText) <= 16) {
            return false;
        }

        $ctext = substr($cipherText, 0, -16);
        $authTag = substr($cipherText, -16);

        return openssl_decrypt($ctext, 'aes-256-gcm', $aesKey, OPENSSL_RAW_DATA, $nonce, $authTag, $associatedData);
    }
}
