<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 21:21
 */
namespace DesignPatterns\Singletons;

use QCloud\ConfigCos;
use Tool\Tool;
use Traits\SingletonTrait;

class QCloudConfigSingleton
{
    use SingletonTrait;

    /**
     * 对象存储配置
     * @var \QCloud\ConfigCos
     */
    private $cosConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\QCloudConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \QCloud\ConfigCos
     */
    public function getCosConfig()
    {
        if (is_null($this->cosConfig)) {
            $configs = Tool::getConfig('qcloud.' . SY_ENV . SY_PROJECT);
            $cosConfig = new ConfigCos();
            $cosConfig->setAppId((string)Tool::getArrayVal($configs, 'cos.app.id', '', true));
            $cosConfig->setSecretId((string)Tool::getArrayVal($configs, 'cos.secret.id', '', true));
            $cosConfig->setSecretKey((string)Tool::getArrayVal($configs, 'cos.secret.key', '', true));
            $cosConfig->setBucketName((string)Tool::getArrayVal($configs, 'cos.bucket.name', '', true));
            $cosConfig->setRegionTag((string)Tool::getArrayVal($configs, 'cos.region.tag', '', true));
            $cosConfig->createReqHost();
            $this->cosConfig = $cosConfig;
        }

        return $this->cosConfig;
    }
}
