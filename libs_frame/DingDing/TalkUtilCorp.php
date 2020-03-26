<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:23
 */
namespace DingDing;

use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\Corp\Common\AccessToken;
use DingDing\Corp\Sns\SnsTokenGet;
use DingDing\Corp\Sns\TokenGet;
use DingDing\Corp\Sso\SsoToken;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class TalkUtilCorp extends TalkUtilBase
{
    use SimpleTrait;

    /**
     * 获取access token
     * @param string $corpId
     * @param string $agentTag
     * @return string
     */
    public static function getAccessToken(string $corpId, string $agentTag) : string
    {
        $nowTime = Tool::getNowTime();
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $redisKey = Project::REDIS_PREFIX_DINGTALK_CORP . $corpId . '_' . $agentInfo['id'];
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['at_key']) && ($redisData['at_key'] == $redisKey) && ($redisData['at_expire'] >= $nowTime)) {
            return $redisData['at_content'];
        }

        $accessTokenObj = new AccessToken($corpId, $agentTag);
        $accessTokenDetail = $accessTokenObj->getDetail();
        unset($accessTokenObj);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'at_content' => $accessTokenDetail['access_token'],
            'at_expire' => (int)($nowTime + 7180),
            'at_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $accessTokenDetail['access_token'];
    }

    /**
     * 获取sso token
     * @param string $corpId
     * @return string
     */
    public static function getSsoToken(string $corpId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_CORP . $corpId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['ssoat_key']) && ($redisData['ssoat_key'] == $redisKey) && ($redisData['ssoat_expire'] >= $nowTime)) {
            return $redisData['ssoat_content'];
        }

        $ssoTokenObj = new SsoToken($corpId);
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
     * @param string $corpId
     * @return string
     */
    public static function getSnsToken(string $corpId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_CORP . $corpId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['snsat_key']) && ($redisData['snsat_key'] == $redisKey) && ($redisData['snsat_expire'] >= $nowTime)) {
            return $redisData['snsat_content'];
        }

        $snsTokenObj = new TokenGet($corpId);
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
     * 获取用户sns token
     * @param string $corpId
     * @param string $openid 用户openid
     * @param string $persistentCode 持久授权码
     * @return string
     */
    public static function getUserSnsToken(string $corpId, string $openid, string $persistentCode) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_DINGTALK_CORP . $corpId . '_' . $openid;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['sns_key']) && ($redisData['sns_key'] == $redisKey) && ($redisData['sns_expire'] >= $nowTime)) {
            return $redisData['sns_content'];
        }

        $snsTokenObj = new SnsTokenGet($corpId);
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
