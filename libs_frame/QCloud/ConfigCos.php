<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:22
 */
namespace QCloud;

use Constant\ErrorCode;
use Exception\QCloud\CosException;

class ConfigCos {
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 帐户ID
     * @var string
     */
    private $secretId = '';
    /**
     * 帐户密钥
     * @var string
     */
    private $secretKey = '';
    /**
     * 容器名称
     * @var string
     */
    private $bucketName = '';
    /**
     * 地域标识
     * @var string
     */
    private $regionTag = '';
    /**
     * 请求域名
     * @var string
     */
    private $reqHost = '';

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
     * @throws \Exception\QCloud\CosException
     */
    public function setAppId(string $appId){
        if (ctype_digit($appId)) {
            $this->appId = $appId;
        } else {
            throw new CosException('应用ID不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSecretId() : string {
        return $this->secretId;
    }

    /**
     * @param string $secretId
     * @throws \Exception\QCloud\CosException
     */
    public function setSecretId(string $secretId){
        if (ctype_alnum($secretId)) {
            $this->secretId = $secretId;
        } else {
            throw new CosException('帐户ID不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSecretKey() : string {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     * @throws \Exception\QCloud\CosException
     */
    public function setSecretKey(string $secretKey){
        if (ctype_alnum($secretKey)) {
            $this->secretKey = $secretKey;
        } else {
            throw new CosException('帐户密钥不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getBucketName() : string {
        return $this->bucketName;
    }

    /**
     * @param string $bucketName
     * @throws \Exception\QCloud\CosException
     */
    public function setBucketName(string $bucketName){
        if (strlen($bucketName) > 0) {
            $this->bucketName = $bucketName;
        } else {
            throw new CosException('容器名称不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getRegionTag() : string {
        return $this->regionTag;
    }

    /**
     * @param string $regionTag
     * @throws \Exception\QCloud\CosException
     */
    public function setRegionTag(string $regionTag){
        if (strlen($regionTag) > 0) {
            $this->regionTag = $regionTag;
        } else {
            throw new CosException('地域标识不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    public function createReqHost(){
        $this->reqHost = $this->bucketName . '-' . $this->appId . '.cos.' . $this->regionTag . '.myqcloud.com';
    }

    /**
     * @return string
     */
    public function getReqHost() : string {
        return $this->reqHost;
    }
}