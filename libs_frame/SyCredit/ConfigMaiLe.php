<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/4/21 0021
 * Time: 14:00
 */
namespace SyCredit;

use SyConstant\ErrorCode;
use SyException\Credit\MaiLeException;

/**
 * Class ConfigMaiLe
 * @package SyCredit
 */
class ConfigMaiLe
{
    /**
     * APP KEY
     * @var string
     */
    private $appKey = '';
    /**
     * APP密钥
     * @var string
     */
    private $appSecret = '';

    /**
     * @return string
     */
    public function getAppKey() : string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     * @throws \SyException\Credit\MaiLeException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new MaiLeException('app key不合法', ErrorCode::CREDIT_PARAM_ERROR);
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
     * @throws \SyException\Credit\MaiLeException
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new MaiLeException('app密钥不合法', ErrorCode::CREDIT_PARAM_ERROR);
        }
    }

    public function __construct()
    {
    }

    private function __clone()
    {
    }
}
