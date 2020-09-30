<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 13:37
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\ObjectStorage\CosException;
use SyException\ObjectStorage\KodoException;
use SyException\ObjectStorage\OssException;
use SyTool\Tool;
use SyTrait\ObjectStorageConfigTrait;
use SyTrait\SingletonTrait;

/**
 * Class ObjectStorageConfigSingleton
 *
 * @package DesignPatterns\Singletons
 */
class ObjectStorageConfigSingleton
{
    use SingletonTrait;
    use ObjectStorageConfigTrait;

    /**
     * 七牛云配置列表
     *
     * @var array
     */
    private $kodoConfigs = [];
    /**
     * 七牛云配置清理时间戳
     *
     * @var int
     */
    private $kodoClearTime = 0;
    /**
     * 腾讯云配置列表
     *
     * @var array
     */
    private $cosConfigs = [];
    /**
     * 腾讯云配置清理时间戳
     *
     * @var int
     */
    private $cosClearTime = 0;
    /**
     * 阿里云配置列表
     *
     * @var array
     */
    private $ossConfigs = [];
    /**
     * 阿里云客户端列表
     *
     * @var array
     */
    private $ossClients = [];
    /**
     * 阿里云配置清理时间戳
     *
     * @var int
     */
    private $ossClearTime = 0;

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
     * @return array
     */
    public function getKodoConfigs() : array
    {
        return $this->kodoConfigs;
    }

    /**
     * 获取七牛云配置
     *
     * @param string $accessKey
     *
     * @return \SyObjectStorage\ConfigKodo
     *
     * @throws \SyException\Cloud\QiNiuException
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function getKodoConfig(string $accessKey)
    {
        $nowTime = Tool::getNowTime();
        $kodoConfig = $this->getLocalKodoConfig($accessKey);
        if (is_null($kodoConfig)) {
            $kodoConfig = $this->refreshKodoConfig($accessKey);
        } elseif ($kodoConfig->getExpireTime() < $nowTime) {
            $kodoConfig = $this->refreshKodoConfig($accessKey);
        }

        if ($kodoConfig->isValid()) {
            return $kodoConfig;
        }

        throw new KodoException('七牛云配置不存在', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
    }

    /**
     * 移除七牛云配置
     *
     * @param string $accessKey
     */
    public function removeKodoConfig(string $accessKey)
    {
        unset($this->kodoConfigs[$accessKey]);
    }

    /**
     * @return array
     */
    public function getCosConfigs() : array
    {
        return $this->cosConfigs;
    }

    /**
     * 获取腾讯云配置
     *
     * @param string $appId
     *
     * @return \SyObjectStorage\ConfigCos
     *
     * @throws \SyException\Cloud\TencentException
     * @throws \SyException\ObjectStorage\CosException
     */
    public function getCosConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        $cosConfig = $this->getLocalCosConfig($appId);
        if (is_null($cosConfig)) {
            $cosConfig = $this->refreshCosConfig($appId);
        } elseif ($cosConfig->getExpireTime() < $nowTime) {
            $cosConfig = $this->refreshCosConfig($appId);
        }

        if ($cosConfig->isValid()) {
            return $cosConfig;
        }

        throw new CosException('腾讯云配置不存在', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
    }

    /**
     * 移除腾讯云配置
     *
     * @param string $appId
     */
    public function removeCosConfig(string $appId)
    {
        unset($this->cosConfigs[$appId]);
    }

    /**
     * @return array
     */
    public function getOssConfigs() : array
    {
        return $this->ossConfigs;
    }

    /**
     * @return array
     */
    public function getOssClients() : array
    {
        return $this->ossClients;
    }

    /**
     * 获取阿里云配置
     *
     * @param string $accessKey
     *
     * @return \SyObjectStorage\ConfigOss
     *
     * @throws \SyException\Cloud\AliException
     * @throws \SyException\ObjectStorage\OssException
     */
    public function getOssConfig(string $accessKey)
    {
        $nowTime = Tool::getNowTime();
        $ossConfig = $this->getLocalOssInfo($accessKey, 1);
        if (is_null($ossConfig)) {
            $ossConfig = $this->refreshOssInfo($accessKey, 1);
        } elseif ($ossConfig->getExpireTime() < $nowTime) {
            $ossConfig = $this->refreshOssInfo($accessKey, 1);
        }

        if ($ossConfig->isValid()) {
            return $ossConfig;
        }

        throw new OssException('阿里云配置不存在', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
    }

    /**
     * 获取阿里云客户端
     *
     * @param string $accessKey
     *
     * @return \SyObjectStorage\Oss\OssClient
     *
     * @throws \SyException\Cloud\AliException
     * @throws \SyException\ObjectStorage\OssException
     */
    public function getOssClient(string $accessKey)
    {
        $nowTime = Tool::getNowTime();
        $ossClient = $this->getLocalOssInfo($accessKey, 2);
        if (is_bool($ossClient)) {
            $ossClient = $this->refreshOssInfo($accessKey, 2);
        } elseif ($ossClient->getExpireTime() < $nowTime) {
            $ossClient = $this->refreshOssInfo($accessKey, 2);
        }

        if (is_bool($ossClient)) {
            throw new OssException('阿里云客户端不存在', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
        }

        return $ossClient;
    }

    /**
     * 移除阿里云信息
     *
     * @param string $accessKey
     */
    public function removeOssInfo(string $accessKey)
    {
        unset($this->ossConfigs[$accessKey], $this->ossClients[$accessKey]);
    }

    /**
     * 获取本地七牛云配置
     *
     * @param string $accessKey
     *
     * @return \SyObjectStorage\ConfigKodo|null
     */
    private function getLocalKodoConfig(string $accessKey)
    {
        $nowTime = Tool::getNowTime();
        if ($this->kodoClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->kodoConfigs as $eAccessKey => $kodoConfig) {
                if ($kodoConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eAccessKey;
                }
            }
            foreach ($delIds as $eAccessKey) {
                unset($this->kodoConfigs[$eAccessKey]);
            }

            $this->kodoClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_OBJECT_STORAGE_KODO_CLEAR;
        }

        return Tool::getArrayVal($this->kodoConfigs, $accessKey, null);
    }

    /**
     * 获取本地腾讯云配置
     *
     * @param string $appId
     *
     * @return \SyObjectStorage\ConfigCos|null
     */
    private function getLocalCosConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->cosClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->cosConfigs as $eAppId => $cosConfig) {
                if ($cosConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eAppId;
                }
            }
            foreach ($delIds as $eAppId) {
                unset($this->cosConfigs[$eAppId]);
            }

            $this->cosClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_OBJECT_STORAGE_COS_CLEAR;
        }

        return Tool::getArrayVal($this->cosConfigs, $appId, null);
    }

    /**
     * 获取本地阿里云信息
     *
     * @param string $accessKey
     * @param int    $getType   获取类型 1:获取阿里云配置 2:获取阿里云客户端
     *
     * @return bool|null|\SyObjectStorage\ConfigOss|\SyObjectStorage\Oss\OssClient
     */
    private function getLocalOssInfo(string $accessKey, int $getType)
    {
        $nowTime = Tool::getNowTime();
        if ($this->ossClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->ossConfigs as $eAccessKey => $ossConfig) {
                if ($ossConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eAccessKey;
                }
            }
            foreach ($delIds as $eAccessKey) {
                unset($this->ossConfigs[$eAccessKey], $this->ossClients[$eAccessKey]);
            }

            $this->ossClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_OBJECT_STORAGE_OSS_CLEAR;
        }

        if ($getType == 1) {
            return Tool::getArrayVal($this->ossConfigs, $accessKey, null);
        }

        return Tool::getArrayVal($this->ossClients, $accessKey, false);
    }
}
