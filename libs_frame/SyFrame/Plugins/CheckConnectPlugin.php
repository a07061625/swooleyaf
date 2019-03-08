<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-15
 * Time: 下午10:21
 */
namespace SyFrame\Plugins;

use DesignPatterns\Singletons\MemCacheSingleton;
use DesignPatterns\Singletons\MysqlSingleton;
use DesignPatterns\Singletons\RedisSingleton;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class CheckConnectPlugin extends Plugin_Abstract {
    public function __construct() {
    }

    private function __clone() {
    }

    public function dispatchLoopStartup(Request_Abstract $request,Response_Abstract $response) {
        RedisSingleton::getInstance()->reConnect();
        if (SY_MEMCACHE) {
            MemCacheSingleton::getInstance()->reConnect();
        }
        if(SY_DATABASE){
            MysqlSingleton::getInstance()->reConnect();
        }
    }
}