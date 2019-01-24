<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/19 0019
 * Time: 12:13
 */
namespace AliOss;

use Constant\ErrorCode;
use Exception\AliOss\OssException;

class ConfigOss {
    /**
     * 终端节点
     * @var string
     */
    private $endpoint = '';
    /**
     * 帐号ID
     * @var string
     */
    private $accessKeyId = '';
    /**
     * 帐号密钥
     * @var string
     */
    private $accessKeySecret = '';
    /**
     * 桶名称
     * @var string
     */
    private $bucketName = '';
    /**
     * 桶域名
     * @var string
     */
    private $bucketDomain = '';

    public function __construct(){
    }

    private function __clone(){
    }

    /**
     * @return string
     */
    public function getEndpoint() : string {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @throws \Exception\AliOss\OssException
     */
    public function setEndpoint(string $endpoint){
        if(preg_match('/^(http|https)\:\/\/\S+$/', $endpoint) > 0){
            $this->endpoint = $endpoint;
        } else {
            throw new OssException('终端节点不合法', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAccessKeyId() : string {
        return $this->accessKeyId;
    }

    /**
     * @param string $accessKeyId
     * @throws \Exception\AliOss\OssException
     */
    public function setAccessKeyId(string $accessKeyId){
        if(ctype_alnum($accessKeyId)){
            $this->accessKeyId = $accessKeyId;
        } else {
            throw new OssException('帐号ID不合法', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAccessKeySecret() : string {
        return $this->accessKeySecret;
    }

    /**
     * @param string $accessKeySecret
     * @throws \Exception\AliOss\OssException
     */
    public function setAccessKeySecret(string $accessKeySecret){
        if(ctype_alnum($accessKeySecret)){
            $this->accessKeySecret = $accessKeySecret;
        } else {
            throw new OssException('帐号密钥不合法', ErrorCode::ALIOSS_PARAM_ERROR);
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
     * @throws \Exception\AliOss\OssException
     */
    public function setBucketName(string $bucketName){
        if (strlen($bucketName) > 0) {
            $this->bucketName = $bucketName;
        } else {
            throw new OssException('桶名称不合法', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getBucketDomain() : string {
        return $this->bucketDomain;
    }

    /**
     * @param string $bucketDomain
     * @throws \Exception\AliOss\OssException
     */
    public function setBucketDomain(string $bucketDomain){
        if(preg_match('/^(http|https)\:\/\/\S+$/', $bucketDomain) > 0){
            $this->bucketDomain = $bucketDomain;
        } else {
            throw new OssException('桶域名不合法', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        return [
            'endpoint' => $this->endpoint,
            'access.key.id' => $this->accessKeyId,
            'access.key.secret' => $this->accessKeySecret,
            'bucket.name' => $this->bucketName,
            'bucket.domain' => $this->bucketDomain,
        ];
    }
}