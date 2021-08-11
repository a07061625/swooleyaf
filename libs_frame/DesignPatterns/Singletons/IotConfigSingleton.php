<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:42
 */
namespace DesignPatterns\Singletons;

use AlibabaCloud\Client\AlibabaCloud;
use SyIot\ConfigAliYun;
use SyIot\ConfigBaiDu;
use SyIot\ConfigTencent;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class IotConfigSingleton
{
    use SingletonTrait;
    /**
     * @var string
     */
    private $aliYunKey = '';
    /**
     * @var \SyIot\ConfigBaiDu
     */
    private $baiDuConfig = null;
    /**
     * @var \SyIot\ConfigTencent
     */
    private $tencentConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\IotConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return string 配置key
     * @throws \SyException\Cloud\AliException|\AlibabaCloud\Client\Exception\ClientException
     */
    public function getAliYunKey()
    {
        if ($this->aliYunKey == '') {
            $configs = Tool::getConfig('iot.' . SY_ENV . SY_PROJECT);
            $config = new ConfigAliYun();
            $config->setRegionId((string)Tool::getArrayVal($configs, 'aliyun.region.id', '', true));
            $config->setAccessKey((string)Tool::getArrayVal($configs, 'aliyun.access.key', '', true));
            $config->setAccessSecret((string)Tool::getArrayVal($configs, 'aliyun.access.secret', '', true));
            $client = AlibabaCloud::accessKeyClient($config->getAccessKey(), $config->getAccessSecret())
                                  ->regionId($config->getRegionId());
            AlibabaCloud::set($config->getAccessKey(), $client);
            $this->aliYunKey = $config->getAccessKey();
        }

        return $this->aliYunKey;
    }

    /**
     * @return \SyIot\ConfigBaiDu
     */
    public function getBaiDuConfig()
    {
        if (is_null($this->baiDuConfig)) {
            $configs = Tool::getConfig('iot.' . SY_ENV . SY_PROJECT);
            $baiDuConfig = new ConfigBaiDu();
            $baiDuConfig->setAccessKey((string)Tool::getArrayVal($configs, 'baidu.access.key', '', true));
            $baiDuConfig->setAccessSecret((string)Tool::getArrayVal($configs, 'baidu.access.secret', '', true));
            $this->baiDuConfig = $baiDuConfig;
        }

        return $this->baiDuConfig;
    }

    /**
     * @return \SyIot\ConfigTencent
     */
    public function getTencentConfig()
    {
        if (is_null($this->tencentConfig)) {
            $configs = Tool::getConfig('iot.' . SY_ENV . SY_PROJECT);
            $tencentConfig = new ConfigTencent();
            $tencentConfig->setRegionId((string)Tool::getArrayVal($configs, 'tencent.region.id', '', true));
            $tencentConfig->setSecretId((string)Tool::getArrayVal($configs, 'tencent.secret.id', '', true));
            $tencentConfig->setSecretKey((string)Tool::getArrayVal($configs, 'tencent.secret.key', '', true));
            $this->tencentConfig = $tencentConfig;
        }

        return $this->tencentConfig;
    }
}
