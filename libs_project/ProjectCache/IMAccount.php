<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/18 0018
 * Time: 10:10
 */

namespace ProjectCache;

use DesignPatterns\Factories\CacheSimpleFactory;
use Factories\SyBaseMysqlFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTrait\SimpleTrait;

class IMAccount
{
    use SimpleTrait;

    public static function getAccountSign(string $appId, string $account)
    {
        $redisKey = self::getSignKey($appId, $account);
        $redisData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
        if ($redisData['unique_key'] && ($redisData['unique_key'] == $redisKey)) {
            return $redisData['sign'];
        }

        $imBase = SyBaseMysqlFactory::getImBaseEntity();
        $ormResult1 = $imBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=? AND `user_id`=?', [$appId, $account]);
        $imBaseInfo = $imBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($imBaseInfo)) {
            throw new CheckException('实时通讯配置不存在', ErrorCode::COMMON_PARAM_ERROR);
        }
        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'unique_key' => $redisKey,
            'sign' => $imBaseInfo['sign'],
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);

        return $imBaseInfo['sign'];
    }

    public static function clearAccountSign(string $appId, string $account)
    {
        $redisKey = self::getSignKey($appId, $account);
        CacheSimpleFactory::getRedisInstance()->del($redisKey);
    }

    private static function getSignKey(string $appId, string $account): string
    {
        return Project::REDIS_PREFIX_IM_ADMIN . $appId . '_' . $account;
    }
}
