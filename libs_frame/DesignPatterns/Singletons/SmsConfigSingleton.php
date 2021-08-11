<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */

namespace DesignPatterns\Singletons;

use SySms\ConfigAliYun;
use SySms\ConfigDaYu;
use SySms\ConfigYun253;
use SyTool\Tool;
use SyTrait\Configs\AliCloudConfigTrait;
use SyTrait\SingletonTrait;

class SmsConfigSingleton
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
     * 大鱼配置
     *
     * @var \SySms\ConfigDaYu
     */
    private $daYuConfig;
    /**
     * 253云配置
     *
     * @var \SySms\ConfigYun253
     */
    private $yun253Config;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\SmsConfigSingleton
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
            $configs = Tool::getConfig('sms.' . SY_ENV . SY_PROJECT);
            $config = new ConfigAliYun();
            $config->setRegionId((string)Tool::getArrayVal($configs, 'aliyun.region.id', '', true));
            $config->setAccessKey((string)Tool::getArrayVal($configs, 'aliyun.app.key', '', true));
            $config->setAccessSecret((string)Tool::getArrayVal($configs, 'aliyun.app.secret', '', true));
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
     * @throws \SyException\Sms\DaYuException
     */
    public function getDaYuConfig(): ConfigDaYu
    {
        if (null === $this->daYuConfig) {
            $configs = Tool::getConfig('sms.' . SY_ENV . SY_PROJECT);
            $daYuConfig = new ConfigDaYu();
            $daYuConfig->setAppKey((string)Tool::getArrayVal($configs, 'dayu.app.key', '', true));
            $daYuConfig->setAppSecret((string)Tool::getArrayVal($configs, 'dayu.app.secret', '', true));
            $this->daYuConfig = $daYuConfig;
        }

        return $this->daYuConfig;
    }

    /**
     * @throws \SyException\Sms\Yun253Exception
     */
    public function getYun253Config(): ConfigYun253
    {
        if (null === $this->yun253Config) {
            $configs = Tool::getConfig('sms.' . SY_ENV . SY_PROJECT);
            $yun253Config = new ConfigYun253();
            $yun253Config->setAppKey((string)Tool::getArrayVal($configs, 'yun253.app.key', '', true));
            $yun253Config->setAppSecret((string)Tool::getArrayVal($configs, 'yun253.app.secret', '', true));
            $yun253Config->setUrlSmsSend((string)Tool::getArrayVal($configs, 'yun253.app.url.sms.send', '', true));
            $this->yun253Config = $yun253Config;
        }

        return $this->yun253Config;
    }
}
