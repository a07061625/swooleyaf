<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:28
 */

namespace SyMap;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\TencentMapException;

class ConfigTencent
{
    /**
     * 开发密钥
     *
     * @var string
     */
    private $key = '';
    /**
     * 服务器IP
     *
     * @var string
     */
    private $serverIp = '';
    /**
     * 域名
     *
     * @var string
     */
    private $domain = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setKey(string $key)
    {
        if (preg_match('/^(\-[0-9A-Z]{5}){6}$/', '-' . $key) > 0) {
            $this->key = $key;
        } else {
            throw new TencentMapException('密钥不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    public function getServerIp(): string
    {
        return $this->serverIp;
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setServerIp(string $serverIp)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $serverIp) > 0) {
            $this->serverIp = $serverIp;
        } else {
            throw new TencentMapException('服务器IP不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setDomain(string $domain)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $domain) > 0) {
            $this->domain = $domain;
        } else {
            throw new TencentMapException('域名不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }
}
