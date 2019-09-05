<?php
/**
 * 缓存简单工厂类
 * User: jw
 * Date: 17-5-29
 * Time: 上午1:11
 */
namespace DesignPatterns\Factories;

use DesignPatterns\Singletons\MemCacheSingleton;
use DesignPatterns\Singletons\RedisSingleton;
use DesignPatterns\Singletons\YacSingleton;
use SyTrait\SimpleTrait;

class CacheSimpleFactory
{
    use SimpleTrait;

    /**
     * 获取redis实例
     * @return \Redis
     */
    public static function getRedisInstance()
    {
        return RedisSingleton::getInstance()->getConn();
    }

    /**
     * 获取yac实例
     * @return \Yac
     */
    public static function getYacInstance()
    {
        return YacSingleton::getInstance();
    }

    /**
     * 获取memcache实例
     * @return \Memcached
     */
    public static function getMemCacheInstance()
    {
        return MemCacheSingleton::getInstance()->getConn();
    }
}
