<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/23 0023
 * Time: 19:32
 */
namespace SyIot;

use Constant\ErrorCode;
use SyException\Iot\TencentIotException;

class ConfigTencent
{
    /**
     * 区域ID
     * @var string
     */
    private $regionId = '';
    /**
     * 应用ID
     * @var string
     */
    private $secretId = '';
    /**
     * 应用密钥
     * @var string
     */
    private $secretKey = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getRegionId() : string
    {
        return $this->regionId;
    }

    /**
     * @param string $regionId
     * @throws \SyException\Iot\TencentIotException
     */
    public function setRegionId(string $regionId)
    {
        $this->regionId = $regionId;
        if (strlen($regionId) > 0) {
            $this->regionId = $regionId;
        } else {
            throw new TencentIotException('区域ID不合法', ErrorCode::IOT_PARAM_ERROR);
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
     * @throws \SyException\Iot\TencentIotException
     */
    public function setSecretId(string $secretId)
    {
        if (ctype_alnum($secretId)) {
            $this->secretId = $secretId;
        } else {
            throw new TencentIotException('应用ID不合法', ErrorCode::IOT_PARAM_ERROR);
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
     * @throws \SyException\Iot\TencentIotException
     */
    public function setSecretKey(string $secretKey)
    {
        if (ctype_alnum($secretKey)) {
            $this->secretKey = $secretKey;
        } else {
            throw new TencentIotException('应用密钥不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }
}
