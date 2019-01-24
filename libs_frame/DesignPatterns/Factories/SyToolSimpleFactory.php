<?php
/**
 * 系统工具简单工厂类
 * User: jw
 * Date: 17-5-29
 * Time: 上午1:34
 */
namespace DesignPatterns\Factories;

use DesignPatterns\Singletons\AliOssSingleton;
use DesignPatterns\Singletons\SolrSingleton;
use Traits\SimpleTrait;

class SyToolSimpleFactory {
    use SimpleTrait;

    /**
     * @return \DesignPatterns\Singletons\AliOssSingleton
     */
    public static function getAliOss() {
        return AliOssSingleton::getInstance();
    }

    /**
     * @return \DesignPatterns\Singletons\SolrSingleton
     */
    public static function getSolr() {
        return SolrSingleton::getInstance();
    }
}