<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/30 0030
 * Time: 10:37
 */
namespace SyTrait;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\ObjectStorage\OssException;
use SyLog\Log;
use SyObjectStorage\ConfigCos;
use SyObjectStorage\ConfigKodo;
use SyObjectStorage\ConfigOss;
use SyObjectStorage\Oss\OssClient;
use SyTool\Tool;

/**
 * Trait ObjectStorageConfigTrait
 *
 * @package SyTrait
 */
trait ObjectStorageConfigTrait
{
    /**
     * 刷新七牛云配置
     *
     * @param string $accessKey
     *
     * @return \SyObjectStorage\ConfigKodo
     *
     * @throws \SyException\Cloud\QiNiuException
     */
    private function refreshKodoConfig(string $accessKey)
    {
        $configs = Tool::getConfig('objectstorage.' . SY_ENV . SY_PROJECT . '.kodo');
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_OBJECT_STORAGE_KODO_REFRESH;
        $kodoConfig = new ConfigKodo();
        $kodoConfig->setAccessKey($accessKey);
        $kodoConfig->setExpireTime($expireTime);
        if (isset($configs[$accessKey])) {
            $kodoConfig->setValid(true);
            $kodoConfig->setSecretKey((string)Tool::getArrayVal($configs[$accessKey], 'secret.key', '', true));
        } else {
            $kodoConfig->setValid(false);
        }
        $this->kodoConfigs[$accessKey] = $kodoConfig;

        return $kodoConfig;
    }

    /**
     * 刷新腾讯云配置
     *
     * @param string $appId
     *
     * @return \SyObjectStorage\ConfigCos
     *
     * @throws \SyException\Cloud\TencentException
     * @throws \SyException\ObjectStorage\CosException
     */
    private function refreshCosConfig(string $appId)
    {
        $configs = Tool::getConfig('objectstorage.' . SY_ENV . SY_PROJECT . '.cos');
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_OBJECT_STORAGE_COS_REFRESH;
        $cosConfig = new ConfigCos();
        $cosConfig->setAppId($appId);
        $cosConfig->setExpireTime($expireTime);
        if (isset($configs[$appId])) {
            $cosConfig->setValid(true);
            $cosConfig->setRegionId((string)Tool::getArrayVal($configs[$appId], 'region.id', '', true));
            $cosConfig->setSecretId((string)Tool::getArrayVal($configs[$appId], 'secret.id', '', true));
            $cosConfig->setSecretKey((string)Tool::getArrayVal($configs[$appId], 'secret.key', '', true));
            $cosConfig->setBucketName((string)Tool::getArrayVal($configs[$appId], 'bucket.name', '', true));
            $cosConfig->setBucketDomain((string)Tool::getArrayVal($configs[$appId], 'bucket.domain', '', true));
            $cosConfig->createReqHost();
        } else {
            $cosConfig->setValid(false);
        }
        $this->cosConfigs[$appId] = $cosConfig;

        return $cosConfig;
    }

    /**
     * 刷新阿里云信息
     *
     * @param string $accessKey
     * @param int    $getType   获取类型 1:获取阿里云配置 2:获取阿里云客户端
     *
     * @return bool|\SyObjectStorage\ConfigOss|\SyObjectStorage\Oss\OssClient
     *
     * @throws \SyException\Cloud\AliException
     * @throws \SyException\ObjectStorage\OssException
     */
    private function refreshOssInfo(string $accessKey, int $getType)
    {
        $configs = Tool::getConfig('objectstorage.' . SY_ENV . SY_PROJECT . '.oss');
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_OBJECT_STORAGE_OSS_REFRESH;
        $ossConfig = new ConfigOss();
        $ossConfig->setAccessKey($accessKey);
        $ossConfig->setExpireTime($expireTime);
        if (isset($configs[$accessKey])) {
            $accessSecret = (string)Tool::getArrayVal($configs[$accessKey], 'access.secret', '', true);
            $endpointDomain = (string)Tool::getArrayVal($configs[$accessKey], 'endpoint.domain', '', true);
            $endpointProtocol = (string)Tool::getArrayVal($configs[$accessKey], 'endpoint.protocol', 'http', true);
            $ossConfig->setValid(true);
            $ossConfig->setRegionId((string)Tool::getArrayVal($configs[$accessKey], 'region.id', '', true));
            $ossConfig->setAccessSecret($accessSecret);
            $ossConfig->setEndpointProtocolAndDomain($endpointProtocol, $endpointDomain);
            $ossConfig->setBucketName((string)Tool::getArrayVal($configs[$accessKey], 'bucket.name', '', true));
            $ossConfig->setBucketDomain((string)Tool::getArrayVal($configs[$accessKey], 'bucket.domain', '', true));

            $initType = (int)Tool::getArrayVal($configs[$accessKey], 'init.type', 1, true);
            $securityToken = (string)Tool::getArrayVal($configs[$accessKey], 'security.token', '', true);
            $requestProxy = (string)Tool::getArrayVal($configs[$accessKey], 'request.proxy', '', true);
            $timeoutTrans = (int)Tool::getArrayVal($configs[$accessKey], 'network.timeout.transmission', 3600, true);
            $timeoutConnect = (int)Tool::getArrayVal($configs[$accessKey], 'network.timeout.connect', 3, true);

            try {
                if ($initType == 1) {
                    $ossClient = new OssClient($accessKey, $accessSecret, $ossConfig->getEndpoint());
                } elseif ($initType == 2) {
                    $ossClient = new OssClient($accessKey, $accessSecret, $ossConfig->getEndpoint(), true);
                } elseif ($initType == 3) {
                    if (strlen($securityToken) == 0) {
                        throw new OssException('加密令牌不能为空', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
                    }
                    $ossClient = new OssClient($accessKey, $accessSecret, $ossConfig->getEndpoint(), false, $securityToken);
                } elseif ($initType == 4) {
                    if (strlen($requestProxy) == 0) {
                        throw new OssException('代理地址不能为空', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
                    }
                    $ossClient = new OssClient($accessKey, $accessSecret, $ossConfig->getEndpoint(), false, null, $requestProxy);
                } else {
                    throw new OssException('初始化类型不支持', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
                }
                $ossClient->setTimeout($timeoutTrans);
                $ossClient->setConnectTimeout($timeoutConnect);
            } catch (\Exception $e) {
                Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

                throw new OssException($e->getMessage(), ErrorCode::OBJECT_STORAGE_OSS_CONNECT_ERROR);
            }
        } else {
            $ossClient = false;
            $ossConfig->setValid(false);
        }
        $this->ossConfigs[$accessKey] = $ossConfig;
        $this->ossClients[$accessKey] = $ossClient;

        if ($getType == 1) {
            return $ossConfig;
        }

        return $ossClient;
    }
}
