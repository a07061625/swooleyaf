<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:24
 */
namespace DingDing;

use SyConstant\ErrorCode;
use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\Corp\Sns\SnsTokenGet;
use DingDing\Corp\Sns\TokenGet;
use DingDing\Corp\Sso\SsoToken;
use DingDing\CorpProvider\Common\CorpToken;
use SyException\DingDing\TalkException;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class TalkUtilProvider extends TalkUtilBase
{
    use SimpleTrait;

    /**
     * 获取服务商套件ticket
     * @return string
     * @throws \SyException\DingDing\TalkException
     */
    public static function getSuiteTicket() : string
    {
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT_SUITE . DingTalkConfigSingleton::getInstance()->getCorpProviderConfig()->getSuiteKey();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)) {
            return $redisData['ticket'];
        } else {
            throw new TalkException('获取服务商套件缓存失败', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * 获取sso token
     * @return string
     */
    public static function getSsoToken() : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT . DingTalkConfigSingleton::getInstance()->getCorpProviderConfig()->getCorpId();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['ssoat_key']) && ($redisData['ssoat_key'] == $redisKey) && ($redisData['ssoat_expire'] >= $nowTime)) {
            return $redisData['ssoat_content'];
        }

        $ssoTokenObj = new SsoToken('');
        $ssoTokenDetail = $ssoTokenObj->getDetail();
        unset($ssoTokenObj);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'ssoat_content' => $ssoTokenDetail['access_token'],
            'ssoat_expire' => (int)($nowTime + 7180),
            'ssoat_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $ssoTokenDetail['access_token'];
    }

    /**
     * 获取sns token
     * @return string
     */
    public static function getSnsToken() : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT . DingTalkConfigSingleton::getInstance()->getCorpProviderConfig()->getCorpId();
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['snsat_key']) && ($redisData['snsat_key'] == $redisKey) && ($redisData['snsat_expire'] >= $nowTime)) {
            return $redisData['snsat_content'];
        }

        $snsTokenObj = new TokenGet('');
        $snsTokenDetail = $snsTokenObj->getDetail();
        unset($snsTokenObj);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'snsat_content' => $snsTokenDetail['access_token'],
            'snsat_expire' => (int)($nowTime + 7180),
            'snsat_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $snsTokenDetail['access_token'];
    }

    /**
     * 获取授权者access token
     * @param string $corpId 授权企业ID
     * @return string
     */
    public static function getAuthorizerAccessToken(string $corpId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_AUTHORIZER . $corpId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['at_key']) && ($redisData['at_key'] == $redisKey) && ($redisData['at_expire'] >= $nowTime)) {
            return $redisData['at_content'];
        }

        $cropToken = new CorpToken();
        $cropToken->setAuthCorpId($corpId);
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
     * 获取用户sns token
     * @param string $openid 用户openid
     * @param string $persistentCode 持久授权码
     * @return string
     */
    public static function getUserSnsToken(string $openid, string $persistentCode) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT . DingTalkConfigSingleton::getInstance()->getCorpProviderConfig()->getCorpId() . '_' . $openid;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['sns_key']) && ($redisData['sns_key'] == $redisKey) && ($redisData['sns_expire'] >= $nowTime)) {
            return $redisData['sns_content'];
        }

        $snsTokenObj = new SnsTokenGet('');
        $snsTokenObj->setOpenid($openid);
        $snsTokenObj->setPersistentCode($persistentCode);
        $snsTokenDetail = $snsTokenObj->getDetail();
        unset($snsTokenObj);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'sns_content' => $snsTokenDetail['sns_token'],
            'sns_expire' => (int)($nowTime + $snsTokenDetail['expires_in'] - 10),
            'sns_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $snsTokenDetail['sns_token'];
    }
}
