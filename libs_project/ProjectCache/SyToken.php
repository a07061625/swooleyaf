<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-19
 * Time: 下午10:41
 */
namespace ProjectCache;

use DesignPatterns\Factories\CacheSimpleFactory;
use Factories\SyBaseMysqlFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTrait\SimpleTrait;

class SyToken
{
    use SimpleTrait;

    public static function getTokenData(string $tag)
    {
        $cacheKey = self::getCacheKey($tag);
        $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll($cacheKey);
        if (isset($cacheData['unique_key'])) {
            if ($cacheData['unique_key'] == $cacheKey) {
                unset($cacheData['unique_key']);

                return $cacheData;
            }

            throw new CheckException('获取令牌缓存出错', ErrorCode::COMMON_SERVER_ERROR);
        }

        $tokenBase = SyBaseMysqlFactory::getSyTokenBaseEntity();
        $ormResult1 = $tokenBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$tag]);
        $tokenInfo = $tokenBase->getContainer()->getModel()->findOne($ormResult1);
        unset($ormResult1, $tokenBase);

        $cacheData = [
            'unique_key' => $cacheKey,
            'title' => '',
            'expire_time' => 0,
        ];
        if (!empty($tokenInfo)) {
            $cacheData['title'] = $tokenInfo['title'];
            $cacheData['expire_time'] = $tokenInfo['expire_time'];
        }
        CacheSimpleFactory::getRedisInstance()->hMset($cacheKey, $cacheData);
        CacheSimpleFactory::getRedisInstance()->expire($cacheKey, 86400);

        unset($cacheData['unique_key']);

        return $cacheData;
    }

    public static function clearTokenData(string $tag)
    {
        $cacheKey = self::getCacheKey($tag);
        CacheSimpleFactory::getRedisInstance()->del($cacheKey);
    }

    private static function getCacheKey(string $tag)
    {
        return Project::REDIS_PREFIX_SY_TOKEN . $tag;
    }
}
