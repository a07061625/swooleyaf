<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/30 0030
 * Time: 11:00
 */
namespace SyMessagePush;

use Constant\ErrorCode;
use Exception\MessagePush\AliPushException;

class ConfigAli {
    /**
     * 访问ID
     * @var string
     */
    private $accessKey = '';
    /**
     * 访问密钥
     * @var string
     */
    private $accessSecret = '';
    /**
     * 区域ID
     * @var string
     */
    private $regionId = '';

    public function __construct(){
    }

    private function __clone(){
    }

    /**
     * @return string
     */
    public function getAccessKey() : string {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     * @throws \Exception\MessagePush\AliPushException
     */
    public function setAccessKey(string $accessKey){
        if(ctype_alnum($accessKey)){
            $this->accessKey = $accessKey;
        } else {
            throw new AliPushException('访问ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAccessSecret() : string {
        return $this->accessSecret;
    }

    /**
     * @param string $accessSecret
     * @throws \Exception\MessagePush\AliPushException
     */
    public function setAccessSecret(string $accessSecret){
        if(ctype_alnum($accessSecret)){
            $this->accessSecret = $accessSecret;
        } else {
            throw new AliPushException('访问密钥不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getRegionId() : string {
        return $this->regionId;
    }

    /**
     * @param string $regionId
     * @throws \Exception\MessagePush\AliPushException
     */
    public function setRegionId(string $regionId){
        if(strlen($regionId) > 0){
            $this->regionId = $regionId;
        } else {
            throw new AliPushException('区域ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }
}