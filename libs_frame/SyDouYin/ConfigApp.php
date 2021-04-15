<?php
/**
 * 应用配置
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:30
 */

namespace SyDouYin;

use SyConstant\ErrorCode;
use SyException\DouYin\DouYinException;
use SyTrait\SimpleConfigTrait;

/**
 * Class ConfigApp
 *
 * @package SyDouYin
 */
class ConfigApp
{
    use SimpleConfigTrait;

    /**
     * 应用标识
     *
     * @var string
     */
    private $clientKey = '';

    /**
     * 应用密钥
     *
     * @var string
     */
    private $clientSecret = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function getClientKey(): string
    {
        return $this->clientKey;
    }

    /**
     * @throws \SyException\DouYin\DouYinException
     */
    public function setClientKey(string $clientKey)
    {
        if (ctype_alnum($clientKey)) {
            $this->clientKey = $clientKey;
        } else {
            throw new DouYinException('应用标识不合法', ErrorCode::DOUYIN_PARAM_ERROR);
        }
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @throws \SyException\DouYin\DouYinException
     */
    public function setClientSecret(string $clientSecret)
    {
        if (ctype_alnum($clientSecret)) {
            $this->clientSecret = $clientSecret;
        } else {
            throw new DouYinException('应用密钥不合法', ErrorCode::DOUYIN_PARAM_ERROR);
        }
    }
}
