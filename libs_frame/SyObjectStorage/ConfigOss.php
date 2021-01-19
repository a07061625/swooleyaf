<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 13:38
 */
namespace SyObjectStorage;

use SyCloud\Ali\ConfigTrait;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\ObjectStorage\OssException;
use SyTrait\SimpleConfigTrait;

/**
 * Class ConfigOss
 *
 * @package SyObjectStorage
 */
class ConfigOss
{
    use ConfigTrait;
    use SimpleConfigTrait;

    /**
     * 终端节点
     *
     * @var string
     */
    private $endpoint = '';
    /**
     * 终端节点域名
     *
     * @var string
     */
    private $endpointDomain = '';
    /**
     * 终端节点协议
     *
     * @var string
     */
    private $endpointProtocol = '';
    /**
     * 桶名称
     *
     * @var string
     */
    private $bucketName = '';
    /**
     * 桶域名
     *
     * @var string
     */
    private $bucketDomain = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getEndpointDomain() : string
    {
        return $this->endpointDomain;
    }

    /**
     * @return string
     */
    public function getEndpointProtocol() : string
    {
        return $this->endpointProtocol;
    }

    /**
     * @param string $endpointProtocol
     * @param string $endpointDomain
     *
     * @throws \SyException\ObjectStorage\OssException
     */
    public function setEndpointProtocolAndDomain(string $endpointProtocol, string $endpointDomain)
    {
        if (!in_array($endpointProtocol, ['http', 'https'])) {
            throw new OssException('终端节点协议不合法', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
        }
        $trueDomain = trim($endpointDomain);
        if (strlen($trueDomain) == 0) {
            throw new OssException('终端节点域名不合法', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
        }
        $this->endpointProtocol = $endpointProtocol;
        $this->endpointDomain = $trueDomain;
        $this->endpoint = $endpointProtocol . '://' . $trueDomain;
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
     * @throws \SyException\ObjectStorage\OssException
     */
    public function setBucketName(string $bucketName)
    {
        if (strlen($bucketName) > 0) {
            $this->bucketName = $bucketName;
        } else {
            throw new OssException('桶名称不合法', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
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
     * @throws \SyException\ObjectStorage\OssException
     */
    public function setBucketDomain(string $bucketDomain)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $bucketDomain) > 0) {
            $this->bucketDomain = $bucketDomain;
        } else {
            throw new OssException('桶域名不合法', ErrorCode::OBJECT_STORAGE_OSS_PARAM_ERROR);
        }
    }
}
