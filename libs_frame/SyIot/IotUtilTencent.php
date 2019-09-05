<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/23 0023
 * Time: 9:01
 */
namespace SyIot;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\IotConfigSingleton;
use Tool\Tool;
use SyTrait\SimpleTrait;

abstract class IotUtilTencent extends IotUtilBase
{
    use SimpleTrait;

    /**
     * 生成TC3签名
     * @param array $data
     * @return array
     */
    public static function createTC3Sign(array $data) : array
    {
        $nowTime = time();
        $dateStr = date('Y-m-d', $nowTime);
        $signedHeaders = 'content-type;host';
        $canonicalRequest = 'POST' . PHP_EOL
                            . '/' . PHP_EOL
                            . PHP_EOL
                            . 'content-type:' . strtolower(trim($data['req_headers']['Content-Type'])) . PHP_EOL
                            . 'host:' . strtolower(trim($data['req_headers']['Host'])) . PHP_EOL . PHP_EOL
                            . $signedHeaders . PHP_EOL
                            . hash('sha256', $data['req_data']);
        $credentialScope = $dateStr . '/' . $data['service_name'] . '/tc3_request';
        $signStr = 'TC3-HMAC-SHA256' . PHP_EOL
                   . $nowTime . PHP_EOL
                   . $credentialScope . PHP_EOL
                   . hash('sha256', $canonicalRequest);
        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $secretDate = hash_hmac('sha256', $dateStr, 'TC3' . $config->getSecretKey());
        $secretService = hash_hmac('sha256', $data['service_name'], $secretDate);
        $secretSign = hash_hmac('sha256', 'tc3_request', $secretService);
        $signature = hash_hmac('sha256', $signStr, $secretSign);
        $authorization = 'TC3-HMAC-SHA256 Credential=' . $config->getSecretId()
                         . '/' . $credentialScope
                         . ', SignedHeaders=' . $signedHeaders
                         . ', Signature=' . $signature;
        return [
            'timestamp' => $nowTime,
            'authorization' => $authorization,
        ];
    }

    /**
     * 发送服务请求
     * @param \SyIot\IotBaseTencent $iotBase
     * @return array
     */
    public static function sendServiceRequest(IotBaseTencent $iotBase)
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $iotBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::IOT_REQ_TENCENT_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['Response'])) {
            if (isset($rspData['Response']['Error'])) {
                $resArr['code'] = ErrorCode::IOT_REQ_TENCENT_ERROR;
                $resArr['msg'] = $rspData['Response']['Error']['Message'];
            } else {
                $resArr['data'] = $rspData['Response'];
            }
        } else {
            $resArr['code'] = ErrorCode::IOT_REQ_TENCENT_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
