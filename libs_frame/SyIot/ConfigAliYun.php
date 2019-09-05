<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/15 0015
 * Time: 11:30
 */
namespace SyIot;

use SyConstant\ErrorCode;
use SyException\Iot\AliYunIotException;

class ConfigAliYun
{
    /**
     * 区域ID
     * @var string
     */
    private $regionId = '';
    /**
     * 访问ID
     * @var string
     */
    private $accessKey = '';
    /**
     * 访问密钥
     * @var string
     */
    private $accessSecret = '';

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
     * @throws \SyException\Iot\AliYunIotException
     */
    public function setRegionId(string $regionId)
    {
        if (strlen($regionId) > 0) {
            $this->regionId = $regionId;
        } else {
            throw new AliYunIotException('区域ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAccessKey() : string
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     * @throws \SyException\Iot\AliYunIotException
     */
    public function setAccessKey(string $accessKey)
    {
        if (ctype_alnum($accessKey)) {
            $this->accessKey = $accessKey;
        } else {
            throw new AliYunIotException('访问ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAccessSecret() : string
    {
        return $this->accessSecret;
    }

    /**
     * @param string $accessSecret
     * @throws \SyException\Iot\AliYunIotException
     */
    public function setAccessSecret(string $accessSecret)
    {
        if (ctype_alnum($accessSecret)) {
            $this->accessSecret = $accessSecret;
        } else {
            throw new AliYunIotException('访问密钥不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }
}
