<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 13:37
 */
namespace DesignPatterns\Singletons;

use SyObjectStorage\ConfigCos;
use SyObjectStorage\ConfigKodo;
use SyTool\Tool;
use SyTrait\SingletonTrait;

/**
 * Class ObjectStorageConfigSingleton
 *
 * @package DesignPatterns\Singletons
 */
class ObjectStorageConfigSingleton
{
    use SingletonTrait;

    /**
     * @var \SyObjectStorage\ConfigKodo
     */
    private $kodoConfig;
    /**
     * @var \SyObjectStorage\ConfigCos
     */
    private $cosConfig;

    /**
     * @return \DesignPatterns\Singletons\ObjectStorageConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyObjectStorage\ConfigKodo
     *
     * @throws \SyException\Cloud\QiNiuException
     */
    public function getKodoConfig()
    {
        if (is_null($this->kodoConfig)) {
            $configs = Tool::getConfig('objectstorage.' . SY_ENV . SY_PROJECT . '.kodo');
            $kodoConfig = new ConfigKodo();
            $kodoConfig->setAccessKey((string)Tool::getArrayVal($configs, 'access.key', '', true));
            $kodoConfig->setSecretKey((string)Tool::getArrayVal($configs, 'secret.key', '', true));
            $this->kodoConfig = $kodoConfig;
        }

        return $this->kodoConfig;
    }

    /**
     * @return \SyObjectStorage\ConfigCos
     *
     * @throws \SyException\Cloud\TencentException
     * @throws \SyException\ObjectStorage\CosException
     */
    public function getCosConfig()
    {
        if (is_null($this->cosConfig)) {
            $configs = Tool::getConfig('objectstorage.' . SY_ENV . SY_PROJECT . '.cos');
            $cosConfig = new ConfigCos();
            $cosConfig->setRegionId((string)Tool::getArrayVal($configs, 'region.id', '', true));
            $cosConfig->setSecretId((string)Tool::getArrayVal($configs, 'secret.id', '', true));
            $cosConfig->setSecretKey((string)Tool::getArrayVal($configs, 'secret.key', '', true));
            $cosConfig->setAppId((string)Tool::getArrayVal($configs, 'app.id', '', true));
            $cosConfig->setBucketName((string)Tool::getArrayVal($configs, 'bucket.name', '', true));
            $cosConfig->setBucketDomain((string)Tool::getArrayVal($configs, 'bucket.domain', '', true));
            $cosConfig->createReqHost();
            $this->cosConfig = $cosConfig;
        }

        return $this->cosConfig;
    }
}
