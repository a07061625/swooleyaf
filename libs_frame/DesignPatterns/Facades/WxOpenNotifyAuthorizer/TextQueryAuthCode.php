<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:57
 */
namespace DesignPatterns\Facades\WxOpenNotifyAuthorizer;

use DesignPatterns\Facades\WxOpenNotifyAuthorizerFacade;
use DesignPatterns\Singletons\WxConfigSingleton;
use Traits\SimpleFacadeTrait;
use Wx\OpenCommon\AuthorizerInfo;
use Wx\Shop\Message\CustomMsgSend;

class TextQueryAuthCode extends WxOpenNotifyAuthorizerFacade {
    use SimpleFacadeTrait;

    protected static function responseNotify(array $data) : array {
        //去除QUERY_AUTH_CODE:
        $authCode = substr($data['Content'], 16);
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        //使用授权码换取公众号的授权信息
        $authorizerInfo = new AuthorizerInfo($openCommonConfig->getAppId());
        $authorizerInfo->setAuthCode($authCode);
        $authInfo = $authorizerInfo->getDetail();
        unset($authorizerInfo);
        //调用发送客服消息api回复文本消息
        $customMsg = new CustomMsgSend('');
        $customMsg->setAccessToken($authInfo['data']['authorization_info']['authorizer_access_token']);
        $customMsg->setMsgData([
            'touser' => $data['FromUserName'],
            'msgtype' => 'text',
            'text' => [
                'content' => $authCode . '_from_api',
            ],
        ]);
        $customMsg->getDetail();
        unset($customMsg);

        return [
            'ToUserName' => $data['FromUserName'],
            'FromUserName' => $data['ToUserName'],
            'CreateTime' => $data['CreateTime'],
            'MsgType' => 'text',
            'Content' => '',
        ];
    }
}