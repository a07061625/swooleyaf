<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 11:06
 */
namespace SyMessagePush;

use Constant\ErrorCode;
use DesignPatterns\Singletons\MessagePushConfigSingleton;
use Tool\Tool;
use Traits\SimpleTrait;

class PushUtilJPush extends PushUtilBase
{
    use SimpleTrait;

    /**
     * 获取授权字符串
     * @param string $key
     * @param string $authType 授权类型 app:应用 group:分组 dev:开发
     * @return string
     */
    public static function getReqAuth(string $key, string $authType)
    {
        if ($authType == 'app') {
            $config = MessagePushConfigSingleton::getInstance()->getJPushAppConfig($key);
            return $config->getAuth();
        } elseif ($authType == 'group') {
            $config = MessagePushConfigSingleton::getInstance()->getJPushGroupConfig($key);
            return $config->getAuth();
        } else {
            $config = MessagePushConfigSingleton::getInstance()->getJPushDevConfig();
            return $config->getAuth();
        }
    }

    public static function sendServiceRequest(PushBaseJPush $pushBase)
    {
        $resArr = [
            'code' => 0,
        ];

        $curlConfigs = $pushBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['error'])) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = $rspData['error']['message'];
        } elseif (is_array($rspData)) {
            $resArr['data'] = $rspData;
        } else {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
