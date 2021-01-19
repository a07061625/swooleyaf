<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:27
 */

namespace SyMap;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\BaiduMapException;

class ConfigBaiDu
{
    /**
     * 开发密钥
     *
     * @var string
     */
    private $ak = '';
    /**
     * 服务器IP
     *
     * @var string
     */
    private $serverIp = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function getAk(): string
    {
        return $this->ak;
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setAk(string $ak)
    {
        if (ctype_alnum($ak) && (32 == \strlen($ak))) {
            $this->ak = $ak;
        } else {
            throw new BaiduMapException('密钥不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    public function getServerIp(): string
    {
        return $this->serverIp;
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setServerIp(string $serverIp)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $serverIp) > 0) {
            $this->serverIp = $serverIp;
        } else {
            throw new BaiduMapException('服务器IP不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }
}
