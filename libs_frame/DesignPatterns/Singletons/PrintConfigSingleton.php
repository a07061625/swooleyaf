<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */
namespace DesignPatterns\Singletons;

use SyPrint\ConfigFeYin;
use Tool\Tool;
use Traits\SingletonTrait;

class PrintConfigSingleton {
    use SingletonTrait;

    /**
     * 飞印配置列表
     * @var array
     */
    private $feYinConfigs = null;

    private function __construct(){
        $configs = Tool::getConfig('print.' . SY_ENV . SY_PROJECT);

        $feYinConfig = new ConfigFeYin();
        $feYinConfig->setAppId((string)Tool::getArrayVal($configs, 'feyin.app.id', '', true));
        $feYinConfig->setAppKey((string)Tool::getArrayVal($configs, 'feyin.app.key', '', true));
        $feYinConfig->setMemberCode((string)Tool::getArrayVal($configs, 'feyin.member.code', '', true));
        $this->feYinConfigs[$feYinConfig->getAppId()] = $feYinConfig;
    }

    /**
     * @return \DesignPatterns\Singletons\PrintConfigSingleton
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return array
     */
    public function getFeYinConfigs() : array {
        return $this->feYinConfigs;
    }

    /**
     * @param \SyPrint\ConfigFeYin $config
     */
    public function addFeYinConfig(ConfigFeYin $config){
        $this->feYinConfigs[$config->getAppId()] = $config;
    }

    /**
     * @param string $appId
     */
    public function removeFeYinConfig(string $appId){
        unset($this->feYinConfigs[$appId]);
    }

    /**
     * @param string $appId
     * @return \SyPrint\ConfigFeYin|null
     */
    public function getFeYinConfig(string $appId) {
        return $this->feYinConfigs[$appId] ?? null;
    }
}