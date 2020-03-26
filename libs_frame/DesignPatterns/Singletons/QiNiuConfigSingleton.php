<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 18:08
 */
namespace DesignPatterns\Singletons;

use QiNiu\ConfigKodo;
use SyTrait\SingletonTrait;
use SyTool\Tool;

class QiNiuConfigSingleton
{
    use SingletonTrait;

    /**
     * @var \QiNiu\ConfigKodo
     */
    private $kodoConfig = null;

    /**
     * @return \DesignPatterns\Singletons\QiNiuConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \QiNiu\ConfigKodo
     */
    public function getKodoConfig()
    {
        if (is_null($this->kodoConfig)) {
            $configs = Tool::getConfig('qiniu.' . SY_ENV . SY_PROJECT);
            $kodoConfig = new ConfigKodo();
            $kodoConfig->setAccessKey((string)Tool::getArrayVal($configs, 'kodo.access.key', '', true));
            $kodoConfig->setSecretKey((string)Tool::getArrayVal($configs, 'kodo.secret.key', '', true));
            $this->kodoConfig = $kodoConfig;
        }

        return $this->kodoConfig;
    }
}
