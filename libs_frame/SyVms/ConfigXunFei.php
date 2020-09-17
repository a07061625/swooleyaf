<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/17 0017
 * Time: 14:17
 */
namespace SyVms;

use SyConstant\ErrorCode;
use SyException\Vms\XunFeiException;

/**
 * Class ConfigXunFei
 *
 * @package SyVms
 */
class ConfigXunFei
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 接口ID
     *
     * @var string
     */
    private $apiKey = '';
    /**
     * 接口密钥
     *
     * @var string
     */
    private $apiSecret = '';

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
     * @throws \SyException\Vms\XunFeiException
     */
    public function setAppId(string $appId)
    {
        if (ctype_alnum($appId)) {
            $this->appId = $appId;
        } else {
            throw new XunFeiException('应用ID不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setApiKey(string $apiKey)
    {
        if (ctype_alnum($apiKey)) {
            $this->apiKey = $apiKey;
        } else {
            throw new XunFeiException('接口ID不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getApiSecret() : string
    {
        return $this->apiSecret;
    }

    /**
     * @param string $apiSecret
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setApiSecret(string $apiSecret)
    {
        if (ctype_alnum($apiSecret)) {
            $this->apiSecret = $apiSecret;
        } else {
            throw new XunFeiException('接口密钥不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }
}
