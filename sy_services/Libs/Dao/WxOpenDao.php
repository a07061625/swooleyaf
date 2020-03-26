<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 18-3-23
 * Time: 上午2:21
 */
namespace Dao;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;
use Wx\WxUtilOpenBase;

class WxOpenDao
{
    use SimpleDaoTrait;

    private static $notifyWxMap = [
        'component_verify_ticket' => '\DesignPatterns\Facades\WxOpenNotifyWx\ComponentVerifyTicket',
        'authorized' => '\DesignPatterns\Facades\WxOpenNotifyWx\Authorized',
        'unauthorized' => '\DesignPatterns\Facades\WxOpenNotifyWx\Unauthorized',
        'updateauthorized' => '\DesignPatterns\Facades\WxOpenNotifyWx\UpdateAuthorized',
        'notify_third_fasteregister' => '\DesignPatterns\Facades\WxOpenNotifyWx\ThirdFastRegister',
    ];
    private static $notifyAuthorizerMap = [
        'event_default' => '\DesignPatterns\Facades\WxOpenNotifyAuthorizer\EventDefault',
        'text_default' => '\DesignPatterns\Facades\WxOpenNotifyAuthorizer\TextDefault',
        'text_query_auth_code' => '\DesignPatterns\Facades\WxOpenNotifyAuthorizer\TextQueryAuthCode',
        'text_test_component' => '\DesignPatterns\Facades\WxOpenNotifyAuthorizer\TextTestComponent',
    ];

    public static function handleNotifyWx(array $data)
    {
        $incomeData = Tool::xmlToArray($data['wx_xml']);
        if (!isset($incomeData['Encrypt'])) {
            return 'fail';
        }
        if (!isset($incomeData['AppId'])) {
            return 'fail';
        }

        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $decryptRes = WxUtilOpenBase::decryptMsg($incomeData['Encrypt'], $openCommonConfig->getAppId(), $openCommonConfig->getToken(), $data['msg_signature'], $data['nonce'], $data['timestamp']);
        $msgData = Tool::xmlToArray($decryptRes['content']);
        $className = Tool::getArrayVal(self::$notifyWxMap, $msgData['InfoType'], null);
        if (!is_null($className)) {
            $className::acceptNotify($msgData);
        }

        return 'success';
    }

    public static function handleNotifyAuthorizer(array $data)
    {
        $incomeData = Tool::xmlToArray($data['wx_xml']);
        if (!isset($incomeData['Encrypt'])) {
            return 'fail';
        }
        if (!isset($incomeData['AppId'])) {
            return 'fail';
        }

        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $decryptRes = WxUtilOpenBase::decryptMsg($incomeData['Encrypt'], $openCommonConfig->getAppId(), $openCommonConfig->getToken(), $data['msg_signature'], $data['nonce'], $data['timestamp']);
        $msgData = Tool::xmlToArray($decryptRes['content']);
        if (!isset($msgData['MsgType'])) {
            return 'fail';
        }

        $notifyTag = self::getAuthorizerNotifyTag($msgData);
        $className = Tool::getArrayVal(self::$notifyAuthorizerMap, $notifyTag, null);
        if (is_null($className)) {
            return 'fail';
        }

        $handleRes = $className::acceptNotify($msgData);
        $replyXml = Tool::arrayToXml($handleRes);
        return WxUtilOpenBase::encryptMsg($replyXml, $openCommonConfig->getAppId(), $openCommonConfig->getToken(), $decryptRes['aes_key']);
    }

    private static function getAuthorizerNotifyTag(array $data) : string
    {
        switch ($data['MsgType']) {
            case 'text':
                $tag = 'text_';
                if ($data['Content'] == 'TESTCOMPONENT_MSG_TYPE_TEXT') {
                    $tag .= 'test_component';
                } elseif (strpos($data['Content'], 'QUERY_AUTH_CODE:') === 0) { //全网开通专用
                    $tag .= 'query_auth_code';
                } else {
                    $tag .= 'default';
                }
                break;
            case 'event':
                $tag = 'event_default';
                break;
            default:
                $tag = '';
        }

        return $tag;
    }
}
