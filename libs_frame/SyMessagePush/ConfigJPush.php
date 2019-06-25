<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 10:56
 */
namespace SyMessagePush;

use Constant\ErrorCode;
use Exception\MessagePush\JPushException;

class ConfigJPush
{
    /**
     * 应用标识
     * @var string
     */
    private $appKey = '';
    /**
     * 应用密钥
     * @var string
     */
    private $masterSecret = '';
    /**
     * 应用密文
     * @var string
     */
    private $appAuth = '';
    /**
     * 开发标识
     * @var string
     */
    private $devKey = '';
    /**
     * 开发密钥
     * @var string
     */
    private $devSecret = '';
    /**
     * 开发密文
     * @var string
     */
    private $devAuth = '';
    /**
     * 分组标识
     * @var string
     */
    private $groupKey = '';
    /**
     * 分组密钥
     * @var string
     */
    private $groupSecret = '';
    /**
     * 分组密文
     * @var string
     */
    private $groupAuth = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getAppKey() : string
    {
        return $this->appKey;
    }

    /**
     * @return string
     */
    public function getMasterSecret() : string
    {
        return $this->masterSecret;
    }

    /**
     * @return string
     */
    public function getAppAuth() : string
    {
        return $this->appAuth;
    }

    /**
     * @param string $appKey
     * @param string $masterSecret
     * @throws \Exception\MessagePush\JPushException
     */
    public function setAppConfig(string $appKey, string $masterSecret)
    {
        if (!ctype_alnum($appKey)) {
            throw new JPushException('应用标识不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!ctype_alnum($masterSecret)) {
            throw new JPushException('应用密钥不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->appKey = $appKey;
        $this->masterSecret = $masterSecret;
        $this->appAuth = 'Basic ' . base64_encode($appKey . ':' . $masterSecret);
    }

    /**
     * @return string
     */
    public function getDevKey() : string
    {
        return $this->devKey;
    }

    /**
     * @return string
     */
    public function getDevSecret() : string
    {
        return $this->devSecret;
    }

    /**
     * @return string
     */
    public function getDevAuth() : string
    {
        return $this->devAuth;
    }

    /**
     * @param string $devKey
     * @param string $devSecret
     * @throws \Exception\MessagePush\JPushException
     */
    public function setDevConfig(string $devKey, string $devSecret)
    {
        if (!ctype_alnum($devKey)) {
            throw new JPushException('开发标识不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!ctype_alnum($devSecret)) {
            throw new JPushException('开发密钥不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->devKey = $devKey;
        $this->devSecret = $devSecret;
        $this->devAuth = 'Basic ' . base64_encode($devKey . ':' . $devSecret);
    }

    /**
     * @return string
     */
    public function getGroupKey() : string
    {
        return $this->groupKey;
    }

    /**
     * @return string
     */
    public function getGroupSecret() : string
    {
        return $this->groupSecret;
    }

    /**
     * @return string
     */
    public function getGroupAuth() : string
    {
        return $this->groupAuth;
    }

    /**
     * @param string $groupKey
     * @param string $groupSecret
     * @throws \Exception\MessagePush\JPushException
     */
    public function setGroupConfig(string $groupKey, string $groupSecret)
    {
        if (!ctype_alnum($groupKey)) {
            throw new JPushException('分组标识不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!ctype_alnum($groupSecret)) {
            throw new JPushException('分组密钥不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->groupKey = $groupKey;
        $this->groupSecret = $groupSecret;
        $this->devAuth = 'Basic ' . base64_encode('group-' . $groupKey . ':' . $groupSecret);
    }
}
