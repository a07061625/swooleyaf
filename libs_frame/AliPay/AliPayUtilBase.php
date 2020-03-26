<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 14:14
 */
namespace AliPay;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\AliPayConfigSingleton;
use SyException\AliPay\AliPayPayException;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class AliPayUtilBase
{
    use SimpleTrait;

    protected static $urlGateWay = 'https://openapi.alipay.com/gateway.do';

    /**
     * 生成签名字符串
     * @param array $data 数据数组
     * @param string $signType 签名方式，只支持RSA和RSA2
     * @return string
     */
    public static function createSign(array $data, string $signType = 'RSA') : string
    {
        $dataStr = self::getSignContent($data);
        $priKey = AliPayConfigSingleton::getInstance()->getPayConfig($data['app_id'])->getPriRsaKeyFull();
        if ('RSA2' == $signType) {
            openssl_sign($dataStr, $signature, $priKey, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($dataStr, $signature, $priKey);
        }

        return base64_encode($signature);
    }

    /**
     * 校验签名
     * @param array $data 数据数组
     * @param string $verifyType 校验类型 1：不校验数据签名类型 2：校验数据签名类型
     * @param string $signType 签名类型,只支持RSA和RSA2
     * @return bool
     */
    public static function verifyData(array $data, string $verifyType = '1', string $signType = 'RSA') : bool
    {
        if (isset($data['sign']) && is_string($data['sign']) && (strlen($data['sign'] . '') > 0)) {
            $sign = $data['sign'];
            $data['sign'] = null;
            if ($verifyType == '1') {
                $data['sign_type'] = null;
            }

            $dataStr = self::getSignContent($data);
            $pubKey = AliPayConfigSingleton::getInstance()->getPayConfig($data['app_id'])->getPubAliKeyFull();
            if ('RSA2' == $signType) {
                $result = (bool)openssl_verify($dataStr, base64_decode($sign, true), $pubKey, OPENSSL_ALGO_SHA256);
            } else {
                $result = (bool)openssl_verify($dataStr, base64_decode($sign, true), $pubKey);
            }

            return $result;
        }

        return false;
    }

    /**
     * 发送服务请求
     * @param \AliPay\AliPayBase $aliBase
     * @return array
     */
    public static function sendServiceRequest(AliPayBase $aliBase)
    {
        $resArr = [
            'code' => 0,
        ];

        $data = $aliBase->getDetail();
        $responseTag = $aliBase->getResponseTag();
        $sendRes = self::sendPostReq(self::$urlGateWay, $data);
        $rspData = Tool::jsonDecode($sendRes);
        if (isset($rspData[$responseTag])) {
            if ($rspData[$responseTag]['code'] == '10000') {
                $resArr['data'] = $rspData[$responseTag];
            } else {
                Log::error(Tool::jsonEncode($rspData[$responseTag], JSON_UNESCAPED_UNICODE), ErrorCode::ALIPAY_POST_ERROR);

                $resArr['code'] = ErrorCode::ALIPAY_POST_ERROR;
                $resArr['message'] = $rspData[$responseTag]['sub_msg'];
            }
        } else {
            Log::error($sendRes, ErrorCode::ALIPAY_POST_ERROR);

            $resArr['code'] = ErrorCode::ALIPAY_POST_ERROR;
            $resArr['message'] = '支付宝返回数据格式出错';
        }

        return $resArr;
    }

    /**
     * 校验$value是否非空
     * @param mixed $value
     * @return bool true：空 false:非空
     */
    protected static function checkEmpty($value) : bool
    {
        if (!isset($value)) {
            return true;
        }
        if ($value === null) {
            return true;
        }
        if (trim($value) === '') {
            return true;
        }

        return false;
    }

    /**
     * 转换字符集编码
     * @param mixed $data
     * @param string $targetCharset
     * @return string
     */
    protected static function convertCharset($data, $targetCharset)
    {
        if (!empty($data)) {
            if (strcasecmp('UTF-8', $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, 'UTF-8');
            }
        }

        return $data;
    }

    /**
     * 获取待签名字符串
     * @param array $params
     * @return string
     */
    protected static function getSignContent(array $params) : string
    {
        $needStr = '';
        ksort($params);

        foreach ($params as $k => $v) {
            if ((false === self::checkEmpty($v)) && ('@' != substr($v, 0, 1))) {
                // 转换成目标字符集
                $needStr .= '&' . $k . '=' . self::convertCharset($v, 'UTF-8');
            }
        }
        unset($k, $v);

        return strlen($needStr) > 0 ? substr($needStr, 1) : '';
    }

    /**
     * 发送POST请求
     * @param string $url 请求地址
     * @param array $data 请求参数
     * @param array $curlConfig curl配置数组
     * @return mixed
     * @throws \SyException\AliPay\AliPayPayException
     */
    protected static function sendPostReq(string $url, array $data, array $curlConfig = [])
    {
        $curlConfig[CURLOPT_URL] = $url;
        $curlConfig[CURLOPT_FAILONERROR] = false;
        $curlConfig[CURLOPT_SSL_VERIFYPEER] = false;
        $curlConfig[CURLOPT_SSL_VERIFYHOST] = false;
        $curlConfig[CURLOPT_POST] = true;
        $curlConfig[CURLOPT_POSTFIELDS] = http_build_query($data);
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        $curlConfig[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
            'Expect:',
        ];
        if (!isset($curlConfig[CURLOPT_TIMEOUT_MS])) {
            $curlConfig[CURLOPT_TIMEOUT_MS] = 2000;
        }

        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            throw new AliPayPayException('curl出错，错误码=' . $sendRes['res_no'], ErrorCode::ALIPAY_POST_ERROR);
        }
    }
}
