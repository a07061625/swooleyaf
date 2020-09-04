<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 13:38
 */
namespace SyObjectStorage;

use SyCloud\Tencent\ConfigTrait;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\CosException;

/**
 * Class ConfigCos
 *
 * @package SyObjectStorage
 */
class ConfigCos
{
    use ConfigTrait;

    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 容器名称
     *
     * @var string
     */
    private $bucketName = '';
    /**
     * 容器域名
     *
     * @var string
     */
    private $bucketDomain = '';
    /**
     * 请求域名
     *
     * @var string
     */
    private $reqHost = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getAppId() : string
    {
        return $this->appId;
    }

    /**
     * @param string $appId
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setAppId(string $appId)
    {
        if (ctype_digit($appId)) {
            $this->appId = $appId;
        } else {
            throw new CosException('应用ID不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getBucketName() : string
    {
        return $this->bucketName;
    }

    /**
     * @param string $bucketName
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setBucketName(string $bucketName)
    {
        if (strlen($bucketName) > 0) {
            $this->bucketName = $bucketName;
        } else {
            throw new CosException('容器名称不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getBucketDomain() : string
    {
        return $this->bucketDomain;
    }

    /**
     * @param string $bucketDomain
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setBucketDomain(string $bucketDomain)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $bucketDomain) > 0) {
            $this->bucketDomain = $bucketDomain;
        } else {
            throw new CosException('桶域名不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    public function createReqHost()
    {
        $this->reqHost = $this->bucketName . '-' . $this->appId . '.cos.' . $this->regionId . '.myqcloud.com';
    }

    /**
     * @return string
     */
    public function getReqHost() : string
    {
        return $this->reqHost;
    }
}
