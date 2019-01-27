<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:23
 */
namespace DingDing;

use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\Corp\Common\AccessToken;
use DingDing\Corp\Sso\SsoToken;
use Tool\Tool;
use Traits\SimpleTrait;

final class TalkUtilCorp extends TalkUtilBase {
    use SimpleTrait;

    /**
     * 获取access token
     * @param string $corpId
     * @param string $agentTag
     * @return string
     */
    public static function getAccessToken(string $corpId,string $agentTag) : string {
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
    public static function getSsoToken(string $corpId) : string {
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
}