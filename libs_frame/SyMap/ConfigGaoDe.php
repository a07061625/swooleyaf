<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-14
 * Time: 下午12:50
 */
namespace SyMap;

use SyConstant\ErrorCode;
use SyException\Map\GaoDeMapException;

class ConfigGaoDe
{
    /**
     * 应用KEY
     * @var string
     */
    private $key = '';
    /**
     * 私钥
     * @var string
     */
    private $secret = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getKey() : string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setKey(string $key)
    {
        if (ctype_alnum($key)) {
            $this->key = $key;
        } else {
            throw new GaoDeMapException('应用KEY不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSecret() : string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setSecret(string $secret)
    {
        if (ctype_alnum($secret)) {
            $this->secret = $secret;
        } else {
            throw new GaoDeMapException('私钥不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }
}
