<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:39
 */
namespace SyPay;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyTrait\SimpleConfigTrait;

/**
 * Class ConfigUnionQuickPass
 *
 * @package SyPay
 */
class ConfigUnionQuickPass
{
    use SimpleConfigTrait;

    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 应用密钥
     *
     * @var string
     */
    private $appSecret = '';

    public function __construct()
    {
    }

    public function __clone()
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
     * @throws \SyException\Pay\UnionException
     */
    public function setAppId(string $appId)
    {
        if (ctype_alnum($appId)) {
            $this->appId = $appId;
        } else {
            throw new UnionException('应用ID不合法', ErrorCode::PAY_PARAM_ERROR);
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
     * @throws \SyException\Pay\UnionException
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new UnionException('应用密钥不合法', ErrorCode::PAY_PARAM_ERROR);
        }
    }
}
