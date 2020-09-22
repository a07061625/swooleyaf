<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/22 0022
 * Time: 14:49
 */
namespace SyVms;

use SyConstant\ErrorCode;
use SyException\Vms\ChiVoxException;

/**
 * Class ConfigChiVox
 *
 * @package SyVms
 */
class ConfigChiVox
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appKey = '';
    /**
     * 应用密钥
     *
     * @var string
     */
    private $appSecret = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getAppKey() : string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     *
     * @throws \SyException\Vms\ChiVoxException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new ChiVoxException('应用ID不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppSecret() : string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     *
     * @throws \SyException\Vms\ChiVoxException
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new ChiVoxException('应用密钥不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }
}
