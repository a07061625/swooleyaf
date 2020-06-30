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
 * @package Wx
 */
abstract class WxUtilPayment extends WxUtilBase
{
    use SimpleTrait;

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

        $keyContent = WxConfigSingleton::getInstance()->getAccountConfig($appId)->getSslCompanyBank();
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

    /**
     * 获取H5支付深度链接
     * @param array $data
     * @return string
     */
    public static function getH5PayDeepLink(array $data) : string
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
        } else {
            $deepLinkUrl = urldecode($matches[1]);
            if (isset($data['redirect_url'])) {
                $deepLinkUrl .= '&redirect_url=' . urlencode($data['redirect_url']);
            }

            return $deepLinkUrl;
        }
    }

    /**
     * 生成V3请求头认证令牌
     * @param array $data
     * @return string
     */
    public static function createV3Token(array $data) : string
    {
        $message = $data['request_method'] . "\n" . $data['request_url'] . "\n" . $data['timestamp'] . "\n" . $data['nonce'] . "\n" . $data['body'] . "\n";
        openssl_sign($message, $rawSign, $data['mch_private_key'], 'sha256WithRSAEncryption');
        $sign = base64_encode($rawSign);
        return 'mchid="' . $data['merchant_id']
               . '",nonce_str="' . $data['nonce']
               . '",timestamp="' . $data['timestamp']
               . '",serial_no="' . $data['serial_no']
               . '",signature="' . $sign . '"';
    }

    //todo: 支付深度链接,参考连接: https://www.cnblogs.com/txw1958/p/wxpayv3_h5.html
}
