<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:42
 */
namespace DesignPatterns\Singletons;

use SyPromotion\ConfigTBK;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class PromotionConfigSingleton
{
    use SingletonTrait;
    /**
     * @var \SyPromotion\ConfigJDK
     */
    private $jdkConfig = null;
    /**
     * @var \SyPromotion\ConfigTBK
     */
    private $tbkConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\PromotionConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyPromotion\ConfigTBK
     * @throws \SyException\Promotion\TBKException
     */
    public function getTBKConfig()
    {
        if (is_null($this->tbkConfig)) {
            $configs = Tool::getConfig('promotion.' . SY_ENV . SY_PROJECT);
            $tbkConfig = new ConfigTBK();
            $tbkConfig->setAppKey((string)Tool::getArrayVal($configs, 'tbk.app.key', '', true));
            $tbkConfig->setAppKey((string)Tool::getArrayVal($configs, 'tbk.app.secret', '', true));
            $this->tbkConfig = $tbkConfig;
        }

        return $this->tbkConfig;
    }
}
