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
use SyVms\ConfigChiVox;
use SyVms\ConfigQCloud;
use SyVms\ConfigXunFei;

class VmsConfigSingleton
{
    use SingletonTrait;

    /**
     * 阿里云配置
     *
     * @var \SyVms\ConfigAliYun
     */
    private $aliYunConfig;
    /**
     * 腾讯云配置
     *
     * @var \SyVms\ConfigQCloud
     */
    private $qCloudConfig;
    /**
     * 科大讯飞配置
     *
     * @var \SyVms\ConfigXunFei
     */
    private $xunFeiConfig;
    /**
     * 驰声配置
     *
     * @var \SyVms\ConfigChiVox
     */
    private $chiVoxConfig;

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
     *
     * @throws \SyException\Cloud\AliException
     */
    public function getAliYunConfig()
    {
        if (is_null($this->aliYunConfig)) {
            $configs = Tool::getConfig('vms.' . SY_ENV . SY_PROJECT);
            $aliYunConfig = new ConfigAliYun();
            $aliYunConfig->setRegionId((string)Tool::getArrayVal($configs, 'aliyun.region.id', '', true));
            $aliYunConfig->setAccessKey((string)Tool::getArrayVal($configs, 'aliyun.access.key', '', true));
            $aliYunConfig->setAccessSecret((string)Tool::getArrayVal($configs, 'aliyun.access.secret', '', true));
            $this->aliYunConfig = $aliYunConfig;
        }

        return $this->aliYunConfig;
    }

    /**
     * @return \SyVms\ConfigQCloud
     *
     * @throws \SyException\Vms\QCloudException
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

    /**
     * @return \SyVms\ConfigXunFei
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function getXunFeiConfig()
    {
        if (is_null($this->xunFeiConfig)) {
            $configs = Tool::getConfig('vms.' . SY_ENV . SY_PROJECT);
            $xunFeiConfig = new ConfigXunFei();
            $xunFeiConfig->setAppId((string)Tool::getArrayVal($configs, 'xunfei.app.id', '', true));
            $xunFeiConfig->setApiKey((string)Tool::getArrayVal($configs, 'xunfei.api.key', '', true));
            $xunFeiConfig->setApiSecret((string)Tool::getArrayVal($configs, 'xunfei.api.secret', '', true));
            $this->xunFeiConfig = $xunFeiConfig;
        }

        return $this->xunFeiConfig;
    }

    /**
     * @return \SyVms\ConfigChiVox
     *
     * @throws \SyException\Vms\ChiVoxException
     */
    public function getChiVoxConfig()
    {
        if (is_null($this->xunFeiConfig)) {
            $configs = Tool::getConfig('vms.' . SY_ENV . SY_PROJECT);
            $chiVoxConfig = new ConfigChiVox();
            $chiVoxConfig->setAppKey((string)Tool::getArrayVal($configs, 'chivox.app.key', '', true));
            $chiVoxConfig->setAppSecret((string)Tool::getArrayVal($configs, 'chivox.app.secret', '', true));
            $this->chiVoxConfig = $chiVoxConfig;
        }

        return $this->chiVoxConfig;
    }
}
