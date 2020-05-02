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
use SyTrait\SimpleFacadeTrait;
use Wx\Account\Message\CustomMsgSend;
use Wx\OpenCommon\AuthorizerInfo;

class TextQueryAuthCode extends WxOpenNotifyAuthorizerFacade
{
    use SimpleFacadeTrait;

    protected static function responseNotify(array $data) : array
    {
        //去除QUERY_AUTH_CODE:
        $authCode = substr($data['Content'], 16);
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        //使用授权码换取公众号的授权信息
        $authorizerInfo = new AuthorizerInfo($openCommonConfig->getAppId());
        $authorizerInfo->setAuthCode($authCode);
        $authInfo = $authorizerInfo->getDetail();
        //调用发送客服消息api回复文本消息
        $customMsg = new CustomMsgSend($authInfo['data']['authorization_info']['authorizer_appid']);
        $customMsg->setAccessToken($authInfo['data']['authorization_info']['authorizer_access_token']);
        $customMsg->setOpenid($data['FromUserName']);
        $customMsg->setMsgInfo('text', [
            'content' => $authCode . '_from_api',
        ]);
        $customMsg->getDetail();

        return [
            'ToUserName' => $data['FromUserName'],
            'FromUserName' => $data['ToUserName'],
            'CreateTime' => $data['CreateTime'],
            'MsgType' => 'text',
            'Content' => '',
        ];
    }
}
