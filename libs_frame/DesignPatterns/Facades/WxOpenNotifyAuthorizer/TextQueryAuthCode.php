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
use Tool\Tool;
use Traits\SimpleFacadeTrait;
use Wx\WxUtilOpenBase;

class TextQueryAuthCode extends WxOpenNotifyAuthorizerFacade {
    use SimpleFacadeTrait;

    protected static function responseNotify(array $data) : array {
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $authCode = str_replace('QUERY_AUTH_CODE:', '', $data['Content']);
        //使用授权码换取公众号的授权信息
        $authInfo = WxUtilOpenBase::getAuthorizerAuth($openCommonConfig->getAppId(), $authCode);
        //调用发送客服消息api回复文本消息
        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $authInfo['data']['authorization_info']['authorizer_access_token'];
        Tool::sendCurlReq([
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => Tool::jsonEncode([
                'touser' => $data['FromUserName'],
                'msgtype' => 'text',
                'text' => [
                    'content' => $authCode . '_from_api',
                ],
            ], JSON_UNESCAPED_UNICODE),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => [
                'Expect:',
            ],
        ]);

        return [
            'ToUserName' => $data['FromUserName'],
            'FromUserName' => $data['ToUserName'],
            'CreateTime' => $data['CreateTime'],
            'MsgType' => 'text',
            'Content' => '',
        ];
    }
}