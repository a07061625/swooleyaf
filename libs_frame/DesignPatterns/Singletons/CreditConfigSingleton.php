<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/4/21 0021
 * Time: 14:22
 */
namespace DesignPatterns\Singletons;

use SyCredit\ConfigMaiLe;
use SyTool\Tool;
use SyTrait\SingletonTrait;

/**
 * Class CreditConfigSingleton
 * @package DesignPatterns\Singletons
 */
class CreditConfigSingleton
{
    use SingletonTrait;

    /**
     * @var \SyCredit\ConfigMaiLe
     */
    private $maiLeConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\CreditConfigSingleton|null
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyCredit\ConfigMaiLe
     */
    public function getMaiLeConfig()
    {
        if (is_null($this->maiLeConfig)) {
            $configs = Tool::getConfig('credit.' . SY_ENV . SY_PROJECT . '.maile');
            $maiLeConfig = new ConfigMaiLe();
            $maiLeConfig->setAppKey((string)Tool::getArrayVal($configs, 'app.key', '', true));
            $maiLeConfig->setAppSecret((string)Tool::getArrayVal($configs, 'app.secret', '', true));
            $this->maiLeConfig = $maiLeConfig;
        }

        return $this->maiLeConfig;
    }
}
