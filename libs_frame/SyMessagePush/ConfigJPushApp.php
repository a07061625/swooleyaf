<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 17:31
 */
namespace SyMessagePush;

use Constant\ErrorCode;
use Exception\MessagePush\JPushException;

class ConfigJPushApp
{
    /**
     * 标识
     * @var string
     */
    private $key = '';
    /**
     * 密钥
     * @var string
     */
    private $secret = '';
    /**
     * 密文
     * @var string
     */
    private $auth = '';
    /**
     * 配置有效状态
     * @var bool
     */
    private $valid = false;

    /**
     * 配置过期时间戳
     * @var int
     */
    private $expireTime = 0;

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
     * @return string
     */
    public function getSecret() : string
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getAuth() : string
    {
        return $this->auth;
    }

    /**
     * @param string $key
     * @param string $secret
     * @throws \Exception\MessagePush\JPushException
     */
    public function setKeyAndSecret(string $key, string $secret)
    {
        if (!ctype_alnum($key)) {
            throw new JPushException('标识不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!ctype_alnum($secret)) {
            throw new JPushException('密钥不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->key = $key;
        $this->secret = $secret;
        $this->auth = 'Basic ' . base64_encode($key . ':' . $secret);
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return int
     */
    public function getExpireTime() : int
    {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime(int $expireTime)
    {
        $this->expireTime = $expireTime;
    }
}
