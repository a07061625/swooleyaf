<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:13
 */
namespace SyVms;

use DesignPatterns\Singletons\VmsConfigSingleton;
use SyConstant\ErrorCode;
use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class VmsUtilQCloud
 * @package SyVms
 */
abstract class VmsUtilQCloud extends VmsUtilBase
{
    use SimpleTrait;

    /**
     * 生成签名
     * @param array $data
     * @return array
     */
    public static function createSign(array $data) : array
    {
        $randomStr = Tool::createNonceStr(16, 'numlower');
        $nowTime = Tool::getNowTime();
        $config = VmsConfigSingleton::getInstance()->getQCloudConfig();
        $signStr = 'appkey=' . $config->getAppKey() . '&random=' . $randomStr . '&time=' . $nowTime . '&mobile=' . $data['mobile'];

        return [
            'random' => $randomStr,
            'time' => $nowTime,
            'app_id' => $config->getAppId(),
            'sign' => hash('sha256', $signStr),
        ];
    }

    /**
     * 发送服务请求
     * @param \SyVms\VmsBaseQCloud $service
     * @return array
     */
    public static function sendServiceRequest(VmsBaseQCloud $service) : array
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $service->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::VMS_REQ_QCLOUD_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['result']) && ($rspData['result'] == 0)) {
            $resArr['data'] = $rspData;
        } else if (isset($rspData['result'])) {
            $resArr['code'] = ErrorCode::VMS_REQ_QCLOUD_ERROR;
            $resArr['msg'] = $rspData['errmsg'];
        } else {
            $resArr['code'] = ErrorCode::VMS_REQ_QCLOUD_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }

        return $resArr;
    }
}
