<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 11:28
 */
namespace Wx;

use SyConstant\ErrorCode;
use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxOpenException;
use SyServer\BaseServer;
use SyTool\ProjectWxTool;
use SyTool\Tool;
use SyTrait\SimpleTrait;
use Wx\Alone\JsTicket;
use Wx\OpenCommon\AuthorizerAccessToken;
use Wx\OpenMini\Cloud\CodeSecretGet;

abstract class WxUtilOpenBase extends WxUtilBase
{
    use SimpleTrait;

    /**
     * 获取平台access token
     * @param string $appId 开放平台app id
     * @return string
     * @throws \SyException\Wx\WxOpenException
     */
    public static function getComponentAccessToken(string $appId) : string
    {
        $redisKey = Project::REDIS_PREFIX_WX_COMPONENT_ACCOUNT . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)) {
            return $redisData['access_token'];
        }

        throw new WxOpenException('获取平台access token失败', ErrorCode::WXOPEN_PARAM_ERROR);
    }

    /**
     * 获取授权者access token
     * @param string $appId 授权公众号app id
     * @return string
     * @throws \SyException\Wx\WxOpenException
     */
    public static function getAuthorizerAccessToken(string $appId) : string
    {
        $cacheInfo = ProjectWxTool::getOpenAuthorizerCache($appId);
        if ($cacheInfo['authorize_status'] == Project::WX_CONFIG_AUTHORIZE_STATUS_EMPTY) {
            throw new WxOpenException('授权公众号不存在', ErrorCode::WXOPEN_PARAM_ERROR);
        } elseif ($cacheInfo['authorize_status'] == Project::WX_CONFIG_AUTHORIZE_STATUS_NO) {
            throw new WxOpenException('公众号已取消授权', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $nowTime = Tool::getNowTime();
        $localCacheTag = Project::LOCAL_CACHE_TAG_WXOPEN_AUTHORIZER . $appId;
        if (SY_LC_WXOPEN_AUTHORIZER) {
            $localCacheData = BaseServer::getWxCache($localCacheTag, '', []);
            if (isset($localCacheData['at_expire']) && ($localCacheData['at_expire'] >= $nowTime)) {
                return $localCacheData['at_content'];
            }
        }

        if (isset($cacheInfo['at_key']) && ($cacheInfo['at_key'] == $cacheInfo['unique_key']) && ($cacheInfo['at_expire'] >= $nowTime)) {
            if (SY_LC_WXOPEN_AUTHORIZER) {
                $clearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXCACHE_CLEAR;
                BaseServer::setWxCache($localCacheTag, [
                    'at_content' => $cacheInfo['at_content'],
                    'at_expire' => (int)$cacheInfo['at_expire'],
                    'clear_time' => $clearTime,
                ]);
            }
            return $cacheInfo['at_content'];
        }

        $authorizerAccessToken = new AuthorizerAccessToken($appId);
        $authorizerAccessToken->setRefreshToken($cacheInfo['refresh_token']);
        $accessTokenData = $authorizerAccessToken->getDetail();

        $expireTime = (int)($nowTime + $accessTokenData['expires_in'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMset($cacheInfo['unique_key'], [
            'at_content' => $accessTokenData['authorizer_access_token'],
            'at_expire' => $expireTime,
            'at_key' => $cacheInfo['unique_key'],
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($cacheInfo['unique_key'], 86400);

        if (SY_LC_WXOPEN_AUTHORIZER) {
            $clearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXCACHE_CLEAR;
            BaseServer::setWxCache($localCacheTag, [
                'at_content' => $accessTokenData['authorizer_access_token'],
                'at_expire' => $expireTime,
                'clear_time' => $clearTime,
            ]);
        }
        return $accessTokenData['authorizer_access_token'];
    }

    /**
     * 获取授权者js ticket
     * @param string $appId 授权者微信号
     * @return string
     */
    public static function getAuthorizerJsTicket(string $appId) : string
    {
        $nowTime = Tool::getNowTime();
        $localCacheTag = Project::LOCAL_CACHE_TAG_WXOPEN_AUTHORIZER . $appId;
        if (SY_LC_WXOPEN_AUTHORIZER) {
            $localCacheData = BaseServer::getWxCache($localCacheTag, '', []);
            if (isset($localCacheData['jt_expire']) && ($localCacheData['jt_expire'] >= $nowTime)) {
                return $localCacheData['jt_content'];
            }
        }

        $redisKey = Project::REDIS_PREFIX_WX_COMPONENT_AUTHORIZER . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['jt_key']) && ($redisData['jt_key'] == $redisKey) && ($redisData['jt_expire'] >= $nowTime)) {
            if (SY_LC_WXOPEN_AUTHORIZER) {
                $clearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXCACHE_CLEAR;
                BaseServer::setWxCache($localCacheTag, [
                    'jt_content' => $redisData['jt_content'],
                    'jt_expire' => (int)$redisData['jt_expire'],
                    'clear_time' => $clearTime,
                ]);
            }
            return $redisData['jt_content'];
        }

        $accessToken = self::getAuthorizerAccessToken($appId);
        $jsTicketObj = new JsTicket();
        $jsTicketObj->setAccessToken($accessToken);
        $jsTicketData = $jsTicketObj->getDetail();

        $expireTime = (int)($nowTime + $jsTicketData['expires_in'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'jt_content' => $jsTicketData['ticket'],
            'jt_expire' => $expireTime,
            'jt_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        if (SY_LC_WXOPEN_AUTHORIZER) {
            $clearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXCACHE_CLEAR;
            BaseServer::setWxCache($localCacheTag, [
                'jt_content' => $jsTicketData['ticket'],
                'jt_expire' => $expireTime,
                'clear_time' => $clearTime,
            ]);
        }
        return $jsTicketData['ticket'];
    }

    /**
     * 获取授权者卡券ticket
     * @param string $appId 授权者微信号
     * @return string
     */
    public static function getAuthorizerCardTicket(string $appId) : string
    {
        $nowTime = Tool::getNowTime();
        $localCacheTag = Project::LOCAL_CACHE_TAG_WXOPEN_AUTHORIZER . $appId;
        if (SY_LC_WXOPEN_AUTHORIZER) {
            $localCacheData = BaseServer::getWxCache($localCacheTag, '', []);
            if (isset($localCacheData['ct_expire']) && ($localCacheData['ct_expire'] >= $nowTime)) {
                return $localCacheData['ct_content'];
            }
        }

        $redisKey = Project::REDIS_PREFIX_WX_COMPONENT_AUTHORIZER . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['ct_key']) && ($redisData['ct_key'] == $redisKey) && ($redisData['ct_expire'] >= $nowTime)) {
            if (SY_LC_WXOPEN_AUTHORIZER) {
                $clearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXCACHE_CLEAR;
                BaseServer::setWxCache($localCacheTag, [
                    'ct_content' => $redisData['ct_content'],
                    'ct_expire' => (int)$redisData['ct_expire'],
                    'clear_time' => $clearTime,
                ]);
            }
            return $redisData['ct_content'];
        }

        $accessToken = self::getAuthorizerAccessToken($appId);
        $jsTicketObj = new JsTicket();
        $jsTicketObj->setAccessToken($accessToken);
        $jsTicketObj->setType('wx_card');
        $jsTicketData = $jsTicketObj->getDetail();

        $expireTime = (int)($nowTime + $jsTicketData['expires_in'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'ct_content' => $jsTicketData['ticket'],
            'ct_expire' => $expireTime,
            'ct_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        if (SY_LC_WXOPEN_AUTHORIZER) {
            $clearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXCACHE_CLEAR;
            BaseServer::setWxCache($localCacheTag, [
                'ct_content' => $jsTicketData['ticket'],
                'ct_expire' => $expireTime,
                'clear_time' => $clearTime,
            ]);
        }
        return $jsTicketData['ticket'];
    }

    /**
     * 密文解密
     * @param string $encryptXml 密文，对应POST请求的数据
     * @param string $appId 开放平台app id
     * @param string $appToken 开放平台消息校验token
     * @param string $msgSignature 签名串，对应URL参数的msg_signature
     * @param string $nonceStr 随机串，对应URL参数的nonce
     * @param string $timestamp 时间戳 对应URL参数的timestamp
     * @return array
     * @throws \SyException\Wx\WxOpenException
     */
    public static function decryptMsg(string $encryptXml, string $appId, string $appToken, string $msgSignature, string $nonceStr, string $timestamp = '') : array
    {
        if ($timestamp) {
            $nowTime = $timestamp . '';
        } else {
            $nowTime = Tool::getNowTime() . '';
        }

        $signature = self::getSha1Val($appToken, $nowTime, $nonceStr, $encryptXml);
        if ($signature != $msgSignature) {
            throw new WxOpenException('签名验证错误', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        try {
            //用当前的key校验密文
            $res = self::decrypt($encryptXml, $appId, 'new');
        } catch (\Exception $e) {
            //用上次的key校验密文
            $res = self::decrypt($encryptXml, $appId, 'old');
        }

        return $res;
    }

    /**
     * 明文加密
     * @param string $replyMsg 公众平台待回复用户的消息，xml格式的字符串
     * @param string $appId 开放平台app id
     * @param string $appToken 开放平台消息校验token
     * @param string $aesKey 第三方平台的aes key
     * @return string 加密后的可以直接回复用户的密文，包括msg_signature, timestamp, nonce, encrypt的xml格式的字符串
     * @throws \SyException\Wx\WxOpenException
     */
    public static function encryptMsg(string $replyMsg, string $appId, string $appToken, string $aesKey) : string
    {
        $nonceStr = Tool::createNonceStr(16);
        $nowTime = Tool::getNowTime() . '';
        $encryptMsg = self::encrypt($replyMsg, $appId, $aesKey, $nonceStr);
        $signature = self::getSha1Val($appToken, $nowTime, $nonceStr, $encryptMsg);
        $format = '<xml><Encrypt><![CDATA[%s]]></Encrypt><MsgSignature><![CDATA[%s]]></MsgSignature><TimeStamp>%s</TimeStamp><Nonce><![CDATA[%s]]></Nonce></xml>';
        return sprintf($format, $encryptMsg, $signature, $nowTime, $nonceStr);
    }

    /**
     * 消息解密
     * @param string $encryptMsg 加密消息
     * @param string $appId 开放平台app id
     * @param string $tag 标识 new：用新的aeskey解密 old：用旧的aeskey解密
     * @return array
     * @throws \SyException\Wx\WxOpenException
     */
    private static function decrypt(string $encryptMsg, string $appId, string $tag = 'new') : array
    {
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        if ($tag == 'new') {
            $aesKey = $openCommonConfig->getAesKeyNow();
            $key = base64_decode($aesKey . '=', true);
            $iv = substr($key, 0, 16);
        } else {
            $aesKey = $openCommonConfig->getAesKeyBefore();
            $key = base64_decode($aesKey . '=', true);
            $iv = substr($key, 0, 16);
        }

        $error = '';
        $xml = '';
        $decryptMsg = openssl_decrypt($encryptMsg, 'AES-256-CBC', substr($key, 0, 32), OPENSSL_ZERO_PADDING, $iv);
        $decodeMsg = Tool::pkcs7Decode($decryptMsg);
        if (strlen($decodeMsg) >= 16) {
            $msgContent = substr($decodeMsg, 16);
            $lengthList = unpack('N', substr($msgContent, 0, 4));
            $xml = substr($msgContent, 4, $lengthList[1]);
            $fromAppId = substr($msgContent, ($lengthList[1] + 4));
            if ($fromAppId != $appId) {
                $error = 'appid不匹配';
            }
        } else {
            $error = '解密失败';
        }

        if (strlen($error) > 0) {
            throw new WxOpenException($error, ErrorCode::WXOPEN_PARAM_ERROR);
        }

        return [
            'aes_key' => $aesKey,
            'content' => $xml,
        ];
    }

    /**
     * 消息加密
     * @param string $replyMsg 公众平台待回复用户的消息，xml格式的字符串
     * @param string $appId 开放平台app id
     * @param string $aesKey 第三方平台的aes key
     * @param string $nonce 16位随机字符串
     * @return string
     */
    private static function encrypt(string $replyMsg, string $appId, string $aesKey, string $nonce) : string
    {
        $key = base64_decode($aesKey . '=', true);
        $iv = substr($key, 0, 16);

        //获得16位随机字符串，填充到明文之前
        $content1 = $nonce . pack('N', strlen($replyMsg)) . $replyMsg . $appId;
        $content2 = Tool::pkcs7Encode($content1);
        return openssl_encrypt($content2, 'AES-256-CBC', substr($key, 0, 32), OPENSSL_ZERO_PADDING, $iv);
    }

    /**
     * 获取授权者代码保护密钥
     * @param string $appId
     * @return string
     * @throws \SyException\Wx\WxOpenException
     */
    public static function getAuthorizerCodeSecret(string $appId) : string
    {
        $redisKey = Project::REDIS_PREFIX_WX_COMPONENT_AUTHORIZER_CODE_SECRET . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)) {
            return $redisData['code_secret'];
        }

        $codeSecretGet = new CodeSecretGet($appId);
        $getRes = $codeSecretGet->getDetail();
        if ($getRes['code'] > 0) {
            throw new WxOpenException($getRes['message'], $getRes['code']);
        }

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'unique_key' => $redisKey,
            'code_secret' => $getRes['data']['codesecret'],
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);
        return $getRes['data']['codesecret'];
    }
}
