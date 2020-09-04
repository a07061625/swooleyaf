<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 13:37
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyException\ObjectStorage\OssException;
use SyLog\Log;
use SyObjectStorage\ConfigCos;
use SyObjectStorage\ConfigKodo;
use SyObjectStorage\ConfigOss;
use SyObjectStorage\Oss\OssClient;
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
     * @var \SyObjectStorage\ConfigOss
     */
    private $ossConfig;
    /**
     * @var \SyObjectStorage\Oss\OssClient
     */
    private $ossClient;

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

    /**
     * @return \SyObjectStorage\ConfigOss
     *
     * @throws \SyException\Cloud\AliException
     * @throws \SyException\ObjectStorage\OssException
     */
    public function getOssConfig()
    {
        if (is_null($this->ossConfig)) {
            $configs = Tool::getConfig('objectstorage.' . SY_ENV . SY_PROJECT . '.oss');
            $endpointDomain = (string)Tool::getArrayVal($configs, 'endpoint.domain', '', true);
            $endpointProtocol = (string)Tool::getArrayVal($configs, 'endpoint.protocol', 'http', true);
            $ossConfig = new ConfigOss();
            $ossConfig->setRegionId((string)Tool::getArrayVal($configs, 'region.id', '', true));
            $ossConfig->setAccessKey((string)Tool::getArrayVal($configs, 'access.key', '', true));
            $ossConfig->setAccessSecret((string)Tool::getArrayVal($configs, 'access.secret', '', true));
            $ossConfig->setEndpointProtocolAndDomain($endpointProtocol, $endpointDomain);
            $ossConfig->setBucketName((string)Tool::getArrayVal($configs, 'bucket.name', '', true));
            $ossConfig->setBucketDomain((string)Tool::getArrayVal($configs, 'bucket.domain', '', true));
            $this->ossConfig = $ossConfig;
        }

        return $this->ossConfig;
    }

    /**
     * @return \SyObjectStorage\Oss\OssClient
     *
     * @throws \SyException\Cloud\AliException
     * @throws \SyException\ObjectStorage\OssException
     */
    public function getOssClient()
    {
        if (is_null($this->ossClient)) {
            $ossConfig = $this->getOssConfig();
            $configs = Tool::getConfig('objectstorage.' . SY_ENV . SY_PROJECT . '.oss');
            $initType = (int)Tool::getArrayVal($configs, 'init.type', 1, true);
            $securityToken = (string)Tool::getArrayVal($configs, 'security.token', '', true);
            $requestProxy = (string)Tool::getArrayVal($configs, 'request.proxy', '', true);
            $networkTimeoutTransmission = (int)Tool::getArrayVal($configs, 'network.timeout.transmission', 3600, true);
            $networkTimeoutConnect = (int)Tool::getArrayVal($configs, 'network.timeout.connect', 3, true);

            try {
                switch ($initType) {
                    case 1:
                        $ossClient = new OssClient($ossConfig->getAccessKey(), $ossConfig->getAccessSecret(), $ossConfig->getEndpoint());

                        break;
                    case 2:
                        $ossClient = new OssClient($ossConfig->getAccessKey(), $ossConfig->getAccessSecret(), $ossConfig->getEndpoint(), true);

                        break;
                    case 3:
                        if (strlen($securityToken) == 0) {
                            throw new OssException('加密令牌不能为空', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
                        }
                        $ossClient = new OssClient($ossConfig->getAccessKey(), $ossConfig->getAccessSecret(), $ossConfig->getEndpoint(), false, $securityToken);

                        break;
                    case 4:
                        if (strlen($requestProxy) == 0) {
                            throw new OssException('代理地址不能为空', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
                        }
                        $ossClient = new OssClient($ossConfig->getAccessKey(), $ossConfig->getAccessSecret(), $ossConfig->getEndpoint(), false, null, $requestProxy);

                        break;
                    default:
                        throw new OssException('初始化类型不支持', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
                }

                $ossClient->setTimeout($networkTimeoutTransmission);
                $ossClient->setConnectTimeout($networkTimeoutConnect);
                $this->ossClient = $ossClient;
            } catch (\Exception $e) {
                $this->ossClient = null;
                Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

                throw new OssException($e->getMessage(), ErrorCode::OBJECT_STORAGE_OSS_CONNECT_ERROR);
            }
        }

        return $this->ossClient;
    }
}
