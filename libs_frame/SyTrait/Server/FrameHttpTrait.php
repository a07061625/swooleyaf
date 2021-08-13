<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 17:53
 */

namespace SyTrait\Server;

use DesignPatterns\Factories\CacheSimpleFactory;
use SyConstant\Project;

trait FrameHttpTrait
{
    /**
     * 添加签名缓存
     *
     * @param string $sign 签名信息
     */
    public static function addApiSign(string $sign): bool
    {
        $signKey = Project::YAC_PREFIX_API_SIGN . md5($sign);
        $cacheData = CacheSimpleFactory::getYacInstance()->get($signKey);
        if (\is_string($cacheData)) {
            return false;
        }
        CacheSimpleFactory::getYacInstance()->set($signKey, '1', Project::TIME_EXPIRE_LOCAL_API_SIGN_CACHE);

        return true;
    }

    private function checkServerHttp()
    {
        $this->checkServerBase();
        $this->checkServerHttpTrait();
    }

    private function initTableHttp()
    {
        $this->initTableBase();
        $this->initTableHttpTrait();
    }
}
