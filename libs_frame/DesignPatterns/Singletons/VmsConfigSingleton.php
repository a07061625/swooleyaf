<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */
namespace DesignPatterns\Singletons;

use SyTool\Tool;
use SyTrait\SingletonTrait;
use SyVms\ConfigAliYun;
use SyVms\ConfigQCloud;

class VmsConfigSingleton
{
    use SingletonTrait;

    /**
     * 阿里云配置
     * @var \SyVms\ConfigAliYun
     */
    private $aliYunConfig = null;
    /**
     * 腾讯云配置
     * @var \SyVms\ConfigQCloud
     */
    private $qCloudConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\VmsConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyVms\ConfigAliYun
     */
    public function getAliYunConfig()
    {
        if (is_null($this->aliYunConfig)) {
            $configs = Tool::getConfig('vms.' . SY_ENV . SY_PROJECT);
            $aliYunConfig = new ConfigAliYun();
            $aliYunConfig->setRegionId((string)Tool::getArrayVal($configs, 'aliyun.region.id', '', true));
            $aliYunConfig->setAppKey((string)Tool::getArrayVal($configs, 'aliyun.app.key', '', true));
            $aliYunConfig->setAppSecret((string)Tool::getArrayVal($configs, 'aliyun.app.secret', '', true));
            $this->aliYunConfig = $aliYunConfig;
        }

        return $this->aliYunConfig;
    }

    /**
     * @return \SyVms\ConfigQCloud
     */
    public function getQCloudConfig()
    {
        if (is_null($this->qCloudConfig)) {
            $configs = Tool::getConfig('vms.' . SY_ENV . SY_PROJECT);
            $qCloudConfig = new ConfigQCloud();
            $qCloudConfig->setAppId((string)Tool::getArrayVal($configs, 'qcloud.app.id', '', true));
            $qCloudConfig->setAppKey((string)Tool::getArrayVal($configs, 'qcloud.app.key', '', true));
            $this->qCloudConfig = $qCloudConfig;
        }

        return $this->qCloudConfig;
    }
}
