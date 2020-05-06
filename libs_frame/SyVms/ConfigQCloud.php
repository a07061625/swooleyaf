<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:02
 */
namespace SyVms;

use SyConstant\ErrorCode;
use SyException\Vms\QCloudException;

/**
 * Class ConfigQCloud
 * @package SyVms
 */
class ConfigQCloud
{
    /**
     * APP ID
     * @var string
     */
    private $appId = '';
    /**
     * APP KEY
     * @var string
     */
    private $appKey = '';

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
     * @throws \SyException\Vms\QCloudException
     */
    public function setAppId(string $appId)
    {
        if (ctype_alnum($appId)) {
            $this->appId = $appId;
        } else {
            throw new QCloudException('app id不合法', ErrorCode::VMS_PARAM_ERROR);
        }
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
     * @throws \SyException\Vms\QCloudException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new QCloudException('app key不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }
}
