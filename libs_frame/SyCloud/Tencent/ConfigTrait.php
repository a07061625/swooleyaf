<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:39
 */
namespace SyCloud\Tencent;

use SyConstant\ErrorCode;
use SyException\Cloud\TencentException;

/**
 * Trait ConfigTrait
 *
 * @package SyCloud\Tencent
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
     * 应用ID
     *
     * @var string
     */
    private $secretId = '';
    /**
     * 应用密钥
     *
     * @var string
     */
    private $secretKey = '';

    /**
     * @return string
     */
    public function getRegionId() : string
    {
        return $this->regionId;
    }

    /**
     * @param string $regionId
     *
     * @throws \SyException\Cloud\TencentException
     */
    public function setRegionId(string $regionId)
    {
        if (strlen($regionId) > 0) {
            $this->regionId = $regionId;
        } else {
            throw new TencentException('区域ID不合法', ErrorCode::CLOUD_TENCENT_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSecretId() : string
    {
        return $this->secretId;
    }

    /**
     * @param string $secretId
     *
     * @throws \SyException\Cloud\TencentException
     */
    public function setSecretId(string $secretId)
    {
        if (ctype_alnum($secretId)) {
            $this->secretId = $secretId;
        } else {
            throw new TencentException('应用ID不合法', ErrorCode::CLOUD_TENCENT_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSecretKey() : string
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     *
     * @throws \SyException\Cloud\TencentException
     */
    public function setSecretKey(string $secretKey)
    {
        if (ctype_alnum($secretKey)) {
            $this->secretKey = $secretKey;
        } else {
            throw new TencentException('应用密钥不合法', ErrorCode::CLOUD_TENCENT_ERROR);
        }
    }
}
