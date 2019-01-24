<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/18 0018
 * Time: 10:10
 */
namespace ProjectCache;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\Common\CheckException;
use Factories\SyBaseMysqlFactory;
use Traits\SimpleTrait;

class IMAccount {
    use SimpleTrait;

    private static function getSignKey(string $account) {
        return Project::REDIS_PREFIX_IM_ADMIN . $account;
    }

    public static function getAccountSign(string $account){
        $redisKey = self::getSignKey($account);
        $accountSign = CacheSimpleFactory::getRedisInstance()->get($redisKey);
        if($accountSign === false){
            $imBase = SyBaseMysqlFactory::ImBaseEntity();
            $ormResult1 = $imBase->getContainer()->getModel()->getOrmDbTable();
            $ormResult1->where('`user_id`=?', [$account]);
            $imBaseInfo = $imBase->getContainer()->getModel()->findOne($ormResult1);
            if(empty($imBaseInfo)){
                throw new CheckException('实时通讯配置不存在', ErrorCode::COMMON_PARAM_ERROR);
            }

            CacheSimpleFactory::getRedisInstance()->set($redisKey, $imBaseInfo['sign'], 86400);
            $accountSign = $imBaseInfo['sign'];
            unset($ormResult1, $imBase);
        }

        return $accountSign;
    }

    public static function clearAccountSign(string $account){
        $redisKey = self::getSignKey($account);
        CacheSimpleFactory::getRedisInstance()->del($redisKey);
    }
}