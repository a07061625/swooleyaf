<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 15:49
 */
namespace SyMessagePush;

use Constant\ErrorCode;
use Exception\MessagePush\BaiDuPushException;

class ConfigBaiDu
{
    /**
     * 应用ID
     * @var string
     */
    private $appKey = '';
    /**
     * 应用密钥
     * @var string
     */
    private $appSecret = '';
    /**
     * HTTP客户端信息
     * @var string
     */
    private $httpUserAgent = '';

    public function __construct()
    {
        $this->httpUserAgent = 'BCCS_SDK/3.0 (Darwin; Darwin Kernel Version 14.0.0; x86_64) PHP/'
                               . PHP_VERSION
                               . ' (Baidu Push Server SDK V3.0.0) cli/Unknown ZEND/2.6.0';
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
     * @param string $appKey
     * @throws \Exception\MessagePush\BaiDuPushException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new BaiDuPushException('应用ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
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
     * @throws \Exception\MessagePush\BaiDuPushException
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new BaiDuPushException('应用密钥不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getHttpUserAgent() : string
    {
        return $this->httpUserAgent;
    }
}
