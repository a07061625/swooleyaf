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
        $redisKey = Project::REDIS_PREFIX_DINGTALK_CORP . $corpId . '_' . $agentInfo['key'];
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
}