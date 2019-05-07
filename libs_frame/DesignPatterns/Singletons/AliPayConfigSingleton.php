<?php
/**
 * 支付宝配置单例类
 * User: 姜伟
 * Date: 2017/6/17 0017
 * Time: 19:15
 */
namespace DesignPatterns\Singletons;

use Traits\AliPayConfigTrait;
use Traits\SingletonTrait;

class AliPayConfigSingleton
{
    use SingletonTrait;
    use AliPayConfigTrait;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\AliPayConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取所有的支付配置
     * @return array
     */
    public function getPayConfigs()
    {
        return $this->payConfigs;
    }
}
