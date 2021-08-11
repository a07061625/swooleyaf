<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:38
 */

namespace SyCloud\Ali;

use SyConstant\ErrorCode;
use SyException\Cloud\AliException;

/**
 * Trait ConfigTrait
 *
 * @package SyCloud\Ali
 */
trait ConfigTrait
{
    /**
     * 区域ID
     *
     * @var string
     */
    private $regionId = '';
    /**
     * 访问ID
     *
     * @var string
     */
    private $accessKey = '';
    /**
     * 访问密钥
     *
     * @var string
     */
    private $accessSecret = '';
    /**
     * 附加配置
     *
     * @var array
     */
    private $options = [];
    /**
     * 超时时间,单位为毫秒
     *
     * @var int
     */
    private $timeout = 0;
    /**
     * 连接超时时间,单位为毫秒
     *
     * @var int
     */
    private $connectTimeout = 0;
    /**
     * 调试模式标识 true:开启 false:关闭
     *
     * @var bool
     */
    private $debugTag = false;
    /**
     * 证书信息
     *
     * @var array
     */
    private $certInfo = [];
    /**
     * 代理信息
     *
     * @var array|string
     */
    private $proxyInfo = '';
    /**
     * 校验信息
     *
     * @var mixed
     */
    private $verifyInfo;

    private function __clone()
    {
    }

    public function getRegionId(): string
    {
        return $this->regionId;
    }

    /**
     * @throws \SyException\Cloud\AliException
     */
    public function setRegionId(string $regionId)
    {
        if (\strlen($regionId) > 0) {
            $this->regionId = $regionId;
        } else {
            throw new AliException('区域ID不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }

    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * @throws \SyException\Cloud\AliException
     */
    public function setAccessKey(string $accessKey)
    {
        if (ctype_alnum($accessKey)) {
            $this->accessKey = $accessKey;
        } else {
            throw new AliException('访问ID不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }

    public function getAccessSecret(): string
    {
        return $this->accessSecret;
    }

    /**
     * @throws \SyException\Cloud\AliException
     */
    public function setAccessSecret(string $accessSecret)
    {
        if (ctype_alnum($accessSecret)) {
            $this->accessSecret = $accessSecret;
        } else {
            throw new AliException('访问密钥不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout 超时时间
     *
     * @throws \SyException\Cloud\AliException
     */
    public function setTimeout(int $timeout)
    {
        if ($timeout >= 0) {
            $this->timeout = $timeout;
        } else {
            throw new AliException('超时时间不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }

    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }

    /**
     * @param int $connectTimeout 连接超时时间
     *
     * @throws \SyException\Cloud\AliException
     */
    public function setConnectTimeout(int $connectTimeout)
    {
        if ($connectTimeout >= 0) {
            $this->connectTimeout = $connectTimeout;
        } else {
            throw new AliException('连接超时时间不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }

    public function isDebugTag(): bool
    {
        return $this->debugTag;
    }

    public function setDebugTag(bool $debugTag)
    {
        $this->debugTag = $debugTag;
    }

    public function getCertInfo(): array
    {
        return $this->certInfo;
    }

    /**
     * @param array $certInfo 证书信息
     *
     * @throws \SyException\Cloud\AliException
     */
    public function setCertInfo(array $certInfo)
    {
        if (\is_array($certInfo) && !empty($certInfo)) {
            $this->certInfo = $certInfo;
        } else {
            throw new AliException('证书信息不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }

    /**
     * @return array|string
     */
    public function getProxyInfo()
    {
        return $this->proxyInfo;
    }

    /**
     * @param array|string $proxyInfo 代理信息
     *
     * @throws \SyException\Cloud\AliException
     */
    public function setProxyInfo($proxyInfo)
    {
        if (\is_string($proxyInfo) && (\strlen($proxyInfo) > 0)) {
            $this->proxyInfo = $proxyInfo;
        } elseif (\is_array($proxyInfo) && !empty($proxyInfo)) {
            $this->proxyInfo = $proxyInfo;
        } else {
            throw new AliException('代理信息不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }

    /**
     * @return mixed
     */
    public function getVerifyInfo()
    {
        return $this->verifyInfo;
    }

    /**
     * @param mixed $verifyInfo
     */
    public function setVerifyInfo($verifyInfo)
    {
        $this->verifyInfo = $verifyInfo;
    }
}
