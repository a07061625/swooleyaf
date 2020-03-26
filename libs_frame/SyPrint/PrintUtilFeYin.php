<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/10 0010
 * Time: 18:06
 */
namespace SyPrint;

use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use SyPrint\FeYin\AccessToken;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class PrintUtilFeYin extends PrintUtilBase
{
    use SimpleTrait;

    public static function getAccessToken(string $appId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_PRINT_FEYIN_ACCOUNT . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey) && ($redisData['expire_time'] >= $nowTime)) {
            return $redisData['access_token'];
        }

        $accessTokenObj = new AccessToken($appId);
        $accessTokenDetail = $accessTokenObj->getDetail();
        unset($accessTokenObj);

        $expireTime = (int)($accessTokenDetail['expires_in'] + $nowTime);
        $activeTime = (int)($accessTokenDetail['expires_in'] + 100);
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'access_token' => $accessTokenDetail['access_token'],
            'expire_time' => $expireTime,
            'unique_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, $activeTime);

        return $accessTokenDetail['access_token'];
    }
}
