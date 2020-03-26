<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 17:04
 */
namespace Wx;

use SyConstant\ErrorCode;
use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxCorpProviderException;
use SyTool\ProjectWxTool;
use SyTool\Tool;
use SyTrait\SimpleTrait;
use Wx\Corp\Common\JsTicket;
use Wx\CorpProvider\Common\CorpToken;
use Wx\CorpProvider\Common\ProviderToken;
use Wx\CorpProvider\Common\SuiteAccessToken;

final class WxUtilCorpProvider extends WxUtilBase
{
    use SimpleTrait;

    /**
     * 获取服务商凭证
     * @return string
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public static function getProviderToken() : string
    {
        $nowTime = Tool::getNowTime();
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $redisKey = Project::REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT . $providerConfig->getCorpId();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey) && ($redisData['ct_expire'] >= $nowTime)) {
            return $redisData['ct_content'];
        } elseif (isset($redisData['unique_key']) && ($redisData['unique_key'] != $redisKey)) {
            throw new WxCorpProviderException('获取服务商凭证缓存失败', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $providerToken = new ProviderToken();
        $tokenDetail = $providerToken->getDetail();
        unset($providerToken);

        $expireTime = (int)($nowTime + $tokenDetail['expires_in'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'unique_key' => $redisKey,
            'ct_content' => $tokenDetail['provider_access_token'],
            'ct_expire' => $expireTime,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $tokenDetail['provider_access_token'];
    }

    /**
     * 密文解密
     * @param string $encryptXml 密文,对应POST请求的数据
     * @param string $msgSignature 签名串,对应URL参数的msg_signature
     * @param string $nonceStr 随机串,对应URL参数的nonce
     * @param string $timestamp 时间戳,对应URL参数的timestamp
     * @return string
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public static function decryptMsg(string $encryptXml, string $msgSignature, string $nonceStr, string $timestamp = '') : string
    {
        if (ctype_digit($timestamp)) {
            $nowTime = $timestamp;
        } else {
            $nowTime = (string)Tool::getNowTime();
        }

        $providerToken = WxConfigSingleton::getInstance()->getCorpProviderConfig()->getToken();
        $signature = self::getSha1Val($providerToken, $nowTime, $nonceStr, $encryptXml);
        if ($signature != $msgSignature) {
            throw new WxCorpProviderException('签名验证错误', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        return self::decrypt($encryptXml);
    }

    /**
     * 明文加密
     * @param string $replyMsg 服务商待回复用户的消息,xml格式的字符串
     * @return string 加密后的可以直接回复用户的密文,包括msg_signature, timestamp, nonce, encrypt的xml格式的字符串
     */
    public static function encryptMsg(string $replyMsg) : string
    {
        $nonceStr = Tool::createNonceStr(16);
        $nowTime = (string)Tool::getNowTime();
        $encryptMsg = base64_encode(self::encrypt($replyMsg, $nonceStr));
        $providerToken = WxConfigSingleton::getInstance()->getCorpProviderConfig()->getToken();
        $signature = self::getSha1Val($providerToken, $nowTime, $nonceStr, $encryptMsg);
        $format = '<xml><Encrypt><![CDATA[%s]]></Encrypt><MsgSignature><![CDATA[%s]]></MsgSignature><TimeStamp>%s</TimeStamp><Nonce><![CDATA[%s]]></Nonce></xml>';
        return sprintf($format, $encryptMsg, $signature, $nowTime, $nonceStr);
    }

    /**
     * 获取微信服务商套件ticket
     * @return string
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public static function getSuiteTicket() : string
    {
        $redisKey = Project::REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT_SUITE . WxConfigSingleton::getInstance()->getCorpProviderConfig()->getSuiteId();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)) {
            return $redisData['ticket'];
        } else {
            throw new WxCorpProviderException('获取微信服务商套件缓存失败', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * 获取第三方应用凭证
     * @return string
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public static function getSuiteToken() : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT_SUITE . WxConfigSingleton::getInstance()->getCorpProviderConfig()->getSuiteId();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['at_key']) && ($redisData['at_key'] == $redisKey) && ($redisData['at_expire'] >= $nowTime)) {
            return $redisData['at_content'];
        } elseif (isset($redisData['at_key']) && ($redisData['at_key'] != $redisKey)) {
            throw new WxCorpProviderException('获取第三方应用凭证缓存失败', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $suiteAccessToken = new SuiteAccessToken();
        $tokenDetail = $suiteAccessToken->getDetail();
        unset($suiteAccessToken);

        $expireTime = (int)($nowTime + $tokenDetail['expires_in'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'at_key' => $redisKey,
            'at_content' => $tokenDetail['suite_access_token'],
            'at_expire' => $expireTime,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $tokenDetail['suite_access_token'];
    }

    /**
     * 获取授权者永久授权码
     * @param string $corpId 授权企业ID
     * @return string
     */
    public static function getAuthorizerPermanentCode(string $corpId) : string
    {
        $redisKey = Project::REDIS_PREFIX_WX_PROVIDER_CORP_AUTHORIZER . $corpId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)) {
            return $redisData['permanent_code'];
        }

        $authorizerInfo = ProjectWxTool::getCorpProviderAuthorizerInfo($corpId);
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'unique_key' => $redisKey,
            'permanent_code' => $authorizerInfo['authorizer_permanentcode'],
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $authorizerInfo['authorizer_permanentcode'];
    }

    /**
     * 获取授权者access token
     * @param string $corpId 授权企业ID
     * @return string
     */
    public static function getAuthorizerAccessToken(string $corpId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_WX_PROVIDER_CORP_AUTHORIZER . $corpId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['at_key']) && ($redisData['at_key'] == $redisKey) && ($redisData['at_expire'] >= $nowTime)) {
            return $redisData['at_content'];
        }

        $permanentCode = self::getAuthorizerPermanentCode($corpId);
        $cropToken = new CorpToken();
        $cropToken->setAuthCorpId($corpId);
        $cropToken->setPermanentCode($permanentCode);
        $cropTokenDetail = $cropToken->getDetail();
        unset($cropToken);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'at_key' => $redisKey,
            'at_content' => $cropTokenDetail['access_token'],
            'at_expire' => (int)($nowTime + $cropTokenDetail['expires_in'] - 10),
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $cropTokenDetail['access_token'];
    }

    /**
     * 获取授权者js ticket
     * @param string $corpId 授权企业ID
     * @return string
     */
    public static function getAuthorizerJsTicket(string $corpId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_WX_PROVIDER_CORP_AUTHORIZER . $corpId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['jt_key']) && ($redisData['jt_key'] == $redisKey) && ($redisData['jt_expire'] >= $nowTime)) {
            return $redisData['jt_content'];
        }

        $accessToken = self::getAuthorizerAccessToken($corpId);
        $jsTicketObj = new JsTicket();
        $jsTicketObj->setAccessToken($accessToken);
        $jsTicketData = $jsTicketObj->getDetail();
        unset($jsTicketObj);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'jt_key' => $redisKey,
            'jt_content' => $jsTicketData['ticket'],
            'jt_expire' => (int)($nowTime + $jsTicketData['expires_in'] - 10),
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $jsTicketData['ticket'];
    }

    /**
     * 消息解密
     * @param string $encryptMsg 加密消息
     * @return string
     * @throws \SyException\Wx\WxCorpProviderException
     */
    private static function decrypt(string $encryptMsg) : string
    {
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $aesKey = $providerConfig->getAesKey();
        $key = base64_decode($aesKey . '=', true);
        $iv = substr($key, 0, 16);
        $error = '';
        $xml = '';
        $decryptMsg = openssl_decrypt(base64_decode($encryptMsg, true), 'aes-256-cbc', substr($key, 0, 32), OPENSSL_ZERO_PADDING, $iv);
        $decodeMsg = Tool::pkcs7Decode($decryptMsg);
        if (strlen($decodeMsg) >= 16) {
            $msgContent = substr($decodeMsg, 16);
            $lengthList = unpack('N', substr($msgContent, 0, 4));
            $xml = substr($msgContent, 4, $lengthList[1]);
            $receiveId = substr($msgContent, ($lengthList[1] + 4));
            if ($receiveId != $providerConfig->getCorpId()) {
                $error = '企业ID不匹配';
            }
        } else {
            $error = '解密失败';
        }
        if (strlen($error) > 0) {
            throw new WxCorpProviderException($error, ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        return $xml;
    }

    /**
     * 消息加密
     * @param string $replyMsg 服务商待回复用户的消息，xml格式的字符串
     * @param string $nonce 16位随机字符串
     * @return string
     */
    private static function encrypt(string $replyMsg, string $nonce) : string
    {
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $key = base64_decode($providerConfig->getAesKey() . '=', true);
        $iv = substr($key, 0, 16);

        //获得16位随机字符串，填充到明文之前
        $content1 = $nonce . pack('N', strlen($replyMsg)) . $replyMsg . $providerConfig->getCorpId();
        $content2 = Tool::pkcs7Encode($content1);
        return openssl_encrypt($content2, 'aes-256-cbc', substr($key, 0, 32), OPENSSL_ZERO_PADDING, $iv);
    }
}
