<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 21:19
 */
namespace SyLogistics;

use SyConstant\ErrorCode;
use SyException\Logistics\Kd100Exception;

class ConfigKd100
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 应用密钥
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
     * @throws \SyException\Logistics\Kd100Exception
     */
    public function setAppId(string $appId)
    {
        if (ctype_alnum($appId)) {
            $this->appId = $appId;
        } else {
            throw new Kd100Exception('应用ID不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
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
     * @throws \SyException\Logistics\Kd100Exception
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new Kd100Exception('应用密钥不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }
}
