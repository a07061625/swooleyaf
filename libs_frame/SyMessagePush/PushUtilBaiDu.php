<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 16:33
 */
namespace SyMessagePush;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\MessagePushConfigSingleton;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class PushUtilBaiDu extends PushUtilBase
{
    use SimpleTrait;

    /**
     * 生成签名
     * @param array $data
     * @return string
     */
    public static function createSign(array $data)
    {
        $signStr = $data['http_method'] . $data['url'];
        $reqParams = $data['params'];
        unset($reqParams['sign']);
        ksort($reqParams);
        foreach ($reqParams as $reqKey => $reqVal) {
            $signStr .= $reqKey . '=' . $reqVal;
        }
        $signStr .= MessagePushConfigSingleton::getInstance()->getBaiDuConfig()->getAppSecret();
        return md5(urlencode($signStr));
    }

    /**
     * 发送服务请求
     * @param \SyMessagePush\PushBaseBaiDu $pushBase
     * @return array
     */
    public static function sendServiceRequest(PushBaseBaiDu $pushBase)
    {
        $resArr = [
            'code' => 0,
        ];

        $curlConfigs = $pushBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_BAIDU_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['error_code'])) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_BAIDU_ERROR;
            $resArr['msg'] = $rspData['error_msg'];
        } elseif (is_array($rspData)) {
            $resArr['data'] = $rspData['response_params'] ?? [];
        } else {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_BAIDU_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
