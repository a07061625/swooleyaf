<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:00
 */
namespace SyPromotion;

use DesignPatterns\Singletons\PromotionConfigSingleton;
use SyTaoBao\ServiceBase;

/**
 * Class BaseTBK
 * @package SyPromotion
 */
abstract class BaseTBK extends ServiceBase
{
    public function __construct()
    {
        parent::__construct();
        $config = PromotionConfigSingleton::getInstance()->getTBKConfig();
        $this->appKey = $config->getAppKey();
        $this->appSecret = $config->getAppSecret();
    }

    private function __clone()
    {
    }
}
