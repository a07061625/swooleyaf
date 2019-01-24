<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/30 0030
 * Time: 11:00
 */
namespace SyMessagePush;

use Constant\ErrorCode;
use Exception\MessagePush\XinGePushException;

class ConfigXinGe {
    const PLATFORM_TYPE_IOS = 'ios';
    const PLATFORM_TYPE_ANDROID = 'android';

    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 应用密钥
     * @var string
     */
    private $appSecret = '';
    /**
     * 平台类型
     * @var string
     */
    private $platform = '';

    public function __construct(){
    }

    private function __clone(){
    }

    /**
     * @return string
     */
    public function getAppId() : string {
        return $this->appId;
    }

    /**
     * @param string $appId
     * @throws \Exception\MessagePush\XinGePushException
     */
    public function setAppId(string $appId){
        if(ctype_alnum($appId)){
            $this->appId = $appId;
        } else {
            throw new XinGePushException('应用ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppSecret() : string {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     * @throws \Exception\MessagePush\XinGePushException
     */
    public function setAppSecret(string $appSecret){
        if(ctype_alnum($appSecret)){
            $this->appSecret = $appSecret;
        } else {
            throw new XinGePushException('应用密钥不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPlatform() : string {
        return $this->platform;
    }

    /**
     * @param string $platform
     * @throws \Exception\MessagePush\XinGePushException
     */
    public function setPlatform(string $platform){
        if(in_array($platform, [self::PLATFORM_TYPE_IOS, self::PLATFORM_TYPE_ANDROID])){
            $this->platform = $platform;
        } else {
            throw new XinGePushException('平台类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }
}