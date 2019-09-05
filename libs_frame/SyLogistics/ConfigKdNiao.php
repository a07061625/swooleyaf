<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/28 0028
 * Time: 19:41
 */
namespace SyLogistics;

use SyConstant\ErrorCode;
use SyException\Logistics\KdNiaoException;

class ConfigKdNiao
{
    /**
     * 商户ID
     * @var string
     */
    private $businessId = '';
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
    public function getBusinessId() : string
    {
        return $this->businessId;
    }

    /**
     * @param string $businessId
     * @throws \SyException\Logistics\KdNiaoException
     */
    public function setBusinessId(string $businessId)
    {
        if (ctype_alnum($businessId)) {
            $this->businessId = $businessId;
        } else {
            throw new KdNiaoException('商户ID不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
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
     * @throws \SyException\Logistics\KdNiaoException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new KdNiaoException('应用密钥不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }
}
