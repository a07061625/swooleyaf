<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 19:30
 */
namespace QCloud;

use DesignPatterns\Singletons\QCloudConfigSingleton;
use Log\Log;
use Tool\Tool;
use Traits\SimpleTrait;

final class CloudUtilCos extends CloudUtilBase {
    use SimpleTrait;

    /**
     * 生成参数字符串
     * @param array $data
     * @return string
     */
    private static function createParamStr(array $data) : string {
        $paramStr = '';
        if(!empty($data)){
            foreach ($data as $key => $value) {
                if(is_string($value) || is_numeric($value)){
                    $paramStr .= '&' . $key . '=' . urlencode($value);
                }
            }
        }

        return isset($paramStr{0}) ? substr($paramStr, 1) : '';
    }

    /**
     * 生成签名
     * @param array $data
     * @param array $headers
     * @return bool
     */
    public static function createSign(array $data,array &$headers) : bool {
        $headerList = (array)Tool::getArrayVal($data, 'header_list', []);
        ksort($headerList);
        $paramList = (array)Tool::getArrayVal($data, 'param_list', []);
        ksort($paramList);

        $nowTime = Tool::getNowTime();
        $endTime = $nowTime + $data['expire_time'];
        $signTime = $nowTime . ';' . $endTime;
        $keyTime = $signTime;
        $config = QCloudConfigSingleton::getInstance()->getCosConfig();
        $signKey = hash_hmac('sha1', $keyTime, $config->getSecretKey());
        $httpStr = $data['http_method'] . PHP_EOL . $data['http_uri'] . PHP_EOL . self::createParamStr($paramList) . PHP_EOL . self::createParamStr($headerList) . PHP_EOL;
        $signStr = 'sha1' . PHP_EOL . $signTime . PHP_EOL . sha1($httpStr) . PHP_EOL;
        $headers['Authorization'] = 'q-sign-algorithm=sha1&q-ak=' . $config->getSecretId()
                                    . '&q-sign-time=' . $signTime
                                    . '&q-key-time=' . $keyTime
                                    . '&q-header-list=' . implode(';', array_keys($headerList))
                                    . '&q-url-param-list=' . implode(';', array_keys($paramList))
                                    . '&q-signature=' . hash_hmac('sha1', $signStr, $signKey);
        return true;
    }

    public static function sendServiceRequest(CloudBaseCos $cosBase) {
        $resArr = [
            'code' => 0
        ];

        $data = $cosBase->getDetail();
        $reqMethod = $cosBase->getReqMethod();
        $errNo = CloudBaseCos::$totalReqMethods[$reqMethod];
        $timeout = (int)Tool::getArrayVal($data, CURLOPT_TIMEOUT_MS, 2000);
        $data[CURLOPT_TIMEOUT_MS] = $timeout;
        $sendRes = Tool::sendCurlReq($data);
        if($sendRes['res_no'] > 0){
            Log::error('对象存储请求失败,curl错误码为' . $sendRes['res_no'], $errNo);
            $resArr['code'] = $errNo;
            $resArr['msg'] = $sendRes['res_msg'];
        } else if(substr($sendRes['res_content'], 0, 5) != '<?xml'){
            $resArr['data'] = (string)$sendRes['res_content'];
        } else {
            $rspData = Tool::xmlToArray($sendRes['res_content']);
            if(isset($rspData['Error'])){
                $resArr['code'] = $errNo;
                $resArr['msg'] = $rspData['Error']['Message'];
            } else {
                $resArr['data'] = $rspData;
            }
        }

        return $resArr;
    }
}