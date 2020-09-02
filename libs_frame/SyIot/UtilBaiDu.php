<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 14:10
 */
namespace SyIot;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\IotConfigSingleton;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class UtilBaiDu extends Util
{
    use SimpleTrait;

    /**
     * 生成签名
     * @param array $data
     * @return string
     */
    public static function createSign(array $data)
    {
        $needStr = $data['req_method'] . "\n" . urlencode($data['req_uri']) . "\n";
        unset($data['req_params']['authorization']);
        ksort($data['req_params']);
        $needStr .= http_build_query($data['req_params']);
        ksort($data['req_headers']);
        $reqHeadStr = implode(';', $data['req_headers']);
        $needStr .= "\n" . $reqHeadStr;

        $config = IotConfigSingleton::getInstance()->getBaiDuConfig();
        $authPrefix = 'bce-auth-v1/' . $config->getAccessKey() . '/' . gmdate('Y-m-d\TH:i:s\Z') . '/30';
        $signKey = hash_hmac('sha256', $authPrefix, $config->getAccessSecret());
        return $authPrefix . '/' . $reqHeadStr . '/' . hash_hmac('sha256', $needStr, $signKey);
    }

    /**
     * 发送服务请求
     * @param \SyIot\BaseBaiDu $iotBase
     * @return array
     * @throws \SyException\Common\CheckException
     */
    public static function sendServiceRequest(BaseBaiDu $iotBase)
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $iotBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::IOT_REQ_BAIDU_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['code'])) {
            $resArr['code'] = ErrorCode::IOT_REQ_BAIDU_ERROR;
            $resArr['msg'] = $rspData['message'];
        } elseif (is_array($rspData)) {
            $resArr['data'] = $rspData;
        } else {
            $resArr['data'] = [
                'result' => strlen($sendRes['res_content']) > 0 ? $sendRes['res_content'] : 'success',
            ];
        }

        return $resArr;
    }
}
