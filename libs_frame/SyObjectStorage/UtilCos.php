<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 19:30
 */
namespace SyObjectStorage;

use DesignPatterns\Singletons\ObjectStorageConfigSingleton;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class UtilCos extends Util
{
    use SimpleTrait;

    /**
     * 生成签名
     *
     * @param string $appId
     * @param array  $data
     * @param array  $headers
     *
     * @return bool
     *
     * @throws \SyException\Cloud\TencentException
     * @throws \SyException\ObjectStorage\CosException
     */
    public static function createSign(string $appId, array $data, array &$headers) : bool
    {
        $headerList = (array)Tool::getArrayVal($data, 'header_list', []);
        ksort($headerList);
        $paramList = (array)Tool::getArrayVal($data, 'param_list', []);
        ksort($paramList);

        $nowTime = Tool::getNowTime();
        $endTime = $nowTime + $data['expire_time'];
        $signTime = $nowTime . ';' . $endTime;
        $keyTime = $signTime;
        $config = ObjectStorageConfigSingleton::getInstance()->getCosConfig($appId);
        $signKey = hash_hmac('sha1', $keyTime, $config->getSecretKey());
        $httpStr = $data['http_method'] . PHP_EOL
                   . $data['http_uri'] . PHP_EOL
                   . self::createParamStr($paramList) . PHP_EOL
                   . self::createParamStr($headerList) . PHP_EOL;
        $signStr = 'sha1' . PHP_EOL . $signTime . PHP_EOL . sha1($httpStr) . PHP_EOL;
        $headers['Authorization'] = 'q-sign-algorithm=sha1&q-ak=' . $config->getSecretId()
                                    . '&q-sign-time=' . $signTime
                                    . '&q-key-time=' . $keyTime
                                    . '&q-header-list=' . implode(';', array_keys($headerList))
                                    . '&q-url-param-list=' . implode(';', array_keys($paramList))
                                    . '&q-signature=' . hash_hmac('sha1', $signStr, $signKey);

        return true;
    }

    /**
     * 生成权限策略签名
     *
     * @param string $appId
     * @param array  $policyConfig
     * @param array  $reqData
     *
     * @throws \SyException\Cloud\TencentException
     * @throws \SyException\ObjectStorage\CosException
     */
    public static function createPolicySign(string $appId, array $policyConfig, array &$reqData)
    {
        $nowTime = Tool::getNowTime();
        $endTime = $nowTime + 259200;
        $config = ObjectStorageConfigSingleton::getInstance()->getCosConfig($appId);
        $reqData['q-sign-algorithm'] = 'sha1';
        $reqData['q-ak'] = $config->getSecretId();
        $reqData['q-key-time'] = $nowTime . ';' . $endTime;
        $signKey = hash_hmac('sha1', $reqData['q-key-time'], $config->getSecretKey());

        $policy = Tool::jsonEncode([
            'expiration' => gmdate("Y-m-d\TH:i:s.000\Z", $endTime),
            'conditions' => $policyConfig,
        ], JSON_UNESCAPED_UNICODE);
        $policySign = sha1($policy);
        $reqData['policy'] = base64_encode($policy);
        $reqData['q-signature'] = hash_hmac('sha1', $policySign, $signKey);
    }

    public static function sendServiceRequest(BaseCos $cosBase)
    {
        $resArr = [
            'code' => 0
        ];

        $data = $cosBase->getDetail();
        $reqMethod = strtoupper($cosBase->getReqMethod());
        $errNo = BaseCos::$totalReqMethods[$reqMethod];
        $timeout = (int)Tool::getArrayVal($data, CURLOPT_TIMEOUT_MS, 2000);
        $data[CURLOPT_TIMEOUT_MS] = $timeout;
        $sendRes = Tool::sendCurlReq($data, Tool::CURL_RSP_HEAD_TYPE_HTTP);
        if ($sendRes['res_no'] > 0) {
            Log::error('对象存储请求失败,curl错误码为' . $sendRes['res_no'], $errNo);
            $resArr['code'] = $errNo;
            $resArr['msg'] = $sendRes['res_msg'];

            return $resArr;
        }

        $rspContentType = isset($sendRes['res_header']['Content-Type']) ? strtolower($sendRes['res_header']['Content-Type'][0]) : '';
        if ((strlen($sendRes['res_content']) == 0) || ($rspContentType != 'application/xml')) {
            $resArr['data'] = [
                'code' => $sendRes['res_code'],
                'header' => $sendRes['res_header'],
                'content' => (string)$sendRes['res_content'],
            ];

            return $resArr;
        }

        $rspData = Tool::xmlToArray($sendRes['res_content']);
        if (isset($rspData['Error'])) {
            $resArr['code'] = $errNo;
            $resArr['msg'] = $rspData['Error']['Message'];
        } else {
            $resArr['data'] = [
                'code' => $sendRes['res_code'],
                'header' => $sendRes['res_header'],
                'content' => $rspData,
            ];
        }

        return $resArr;
    }

    /**
     * 生成参数字符串
     *
     * @param array $data
     *
     * @return string
     */
    private static function createParamStr(array $data) : string
    {
        $paramStr = '';
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value) || is_numeric($value)) {
                    $paramStr .= '&' . $key . '=' . urlencode($value);
                }
            }
        }

        return isset($paramStr[0]) ? substr($paramStr, 1) : '';
    }
}
