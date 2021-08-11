<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */

namespace DesignPatterns\Singletons;

use SyTool\Tool;
use SyTrait\Configs\AliCloudConfigTrait;
use SyTrait\SingletonTrait;
use SyVms\ConfigAliYun;
use SyVms\ConfigChiVox;
use SyVms\ConfigQCloud;
use SyVms\ConfigXunFei;

class VmsConfigSingleton
{
    use SingletonTrait;
    use AliCloudConfigTrait;

    /**
     * 阿里云配置Key
     *
     * @var string
     */
    private $aliYunKey = '';
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
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return string 配置key
     *
     * @throws \SyException\Cloud\AliException
     * @throws \AlibabaCloud\Client\Exception\ClientException
     */
    public function getAliYunKey(): string
    {
        if ('' == $this->aliYunKey) {
            $configs = Tool::getConfig('vms.' . SY_ENV . SY_PROJECT);
            $config = new ConfigAliYun();
            $config->setRegionId((string)Tool::getArrayVal($configs, 'aliyun.region.id', '', true));
            $config->setAccessKey((string)Tool::getArrayVal($configs, 'aliyun.access.key', '', true));
            $config->setAccessSecret((string)Tool::getArrayVal($configs, 'aliyun.access.secret', '', true));
            $this->setAliClient($config);
            $this->aliYunKey = $config->getAccessKey();
        }

        return $this->aliYunKey;
    }

    public function removeAliYunKey()
    {
        if (\strlen($this->aliYunKey) > 0) {
            $this->removeAliClient($this->aliYunKey);
            $this->aliYunKey = '';
        }
    }

    /**
     * @throws \SyException\Vms\QCloudException
     */
    public function getQCloudConfig(): ConfigQCloud
    {
        if (null === $this->qCloudConfig) {
            $configs = Tool::getConfig('vms.' . SY_ENV . SY_PROJECT);
            $qCloudConfig = new ConfigQCloud();
            $qCloudConfig->setAppId((string)Tool::getArrayVal($configs, 'qcloud.app.id', '', true));
            $qCloudConfig->setAppKey((string)Tool::getArrayVal($configs, 'qcloud.app.key', '', true));
            $this->qCloudConfig = $qCloudConfig;
        }

        return $this->qCloudConfig;
    }

    /**
     * @throws \SyException\Vms\XunFeiException
     */
    public function getXunFeiConfig(): ConfigXunFei
    {
        if (null === $this->xunFeiConfig) {
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
     * @throws \SyException\Vms\ChiVoxException
     */
    public function getChiVoxConfig(): ConfigChiVox
    {
        if (null === $this->xunFeiConfig) {
            $configs = Tool::getConfig('vms.' . SY_ENV . SY_PROJECT);
            $chiVoxConfig = new ConfigChiVox();
            $chiVoxConfig->setAppKey((string)Tool::getArrayVal($configs, 'chivox.app.key', '', true));
            $chiVoxConfig->setAppSecret((string)Tool::getArrayVal($configs, 'chivox.app.secret', '', true));
            $this->chiVoxConfig = $chiVoxConfig;
        }

        return $this->chiVoxConfig;
    }
}
