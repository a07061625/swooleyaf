<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 17:53
 */
namespace Traits\Server;

use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;

trait BasicHttpTrait {
    private function checkServerHttp() {
        $this->checkServerBase();
        $this->checkServerHttpTrait();
    }

    /**
     * 添加签名缓存
     * @param string $sign 签名信息
     * @return bool
     */
    public static function addApiSign(string $sign) : bool {
        $signKey = Project::YAC_PREFIX_API_SIGN . substr($sign, 0, 16);
        $cacheData = CacheSimpleFactory::getYacInstance()->get($signKey);
        if (is_string($cacheData)) {
            return false;
        } else {
            CacheSimpleFactory::getYacInstance()->set($signKey, '1', Project::TIME_EXPIRE_LOCAL_API_SIGN_CACHE);
            return true;
        }
    }

    private function initTableHttp() {
        $this->initTableBase();
        $this->initTableHttpTrait();
    }
}