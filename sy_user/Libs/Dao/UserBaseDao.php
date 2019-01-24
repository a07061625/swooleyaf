<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/10/31 0031
 * Time: 9:52
 */
namespace Dao;

use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Tool\SySession;
use Traits\SimpleDaoTrait;

class UserBaseDao {
    use SimpleDaoTrait;

    public static function refreshUserSession(string $uid,string $sessionId) {
        $cacheData = [
            'user_id' => $uid,
            'user_account' => 111,
            'user_name' => 111,
            'user_headimage' => 111,
            'user_phone' => 111,
            'user_role' => 111,
        ];

        SySession::set($cacheData, 1, $sessionId);
        $redisKey = Project::REDIS_PREFIX_SESSION_LIST . $cacheData['user_id'];
        CacheSimpleFactory::getRedisInstance()->sAdd($redisKey, $sessionId);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, Project::TIME_EXPIRE_SESSION);

        return [
            'user_id' => $cacheData['user_id'],
            'user_role' => $cacheData['user_role'],
        ];
    }
}