<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 15:49
 */
namespace SyMessagePush;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;

class ConfigBaiDu
{
    const DEVICE_TYPE_ALL = 0; //设备类型-所有
    const DEVICE_TYPE_ANDROID = 3; //设备类型-安卓
    const DEVICE_TYPE_IOS = 4; //设备类型-苹果
    public static $totalDeviceType = [
        self::DEVICE_TYPE_ANDROID => '安卓',
        self::DEVICE_TYPE_IOS => '苹果',
    ];

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
     * 设备类型
     * @var int
     */
    private $deviceType = 0;
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
     * @throws \SyException\MessagePush\BaiDuPushException
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
     * @throws \SyException\MessagePush\BaiDuPushException
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
     * @return int
     */
    public function getDeviceType() : int
    {
        return $this->deviceType;
    }

    /**
     * @param int $deviceType
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setDeviceType(int $deviceType)
    {
        if (in_array($deviceType, [self::DEVICE_TYPE_ALL, self::DEVICE_TYPE_ANDROID, self::DEVICE_TYPE_IOS])) {
            $this->deviceType = $deviceType;
        } else {
            throw new BaiDuPushException('设备类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
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
