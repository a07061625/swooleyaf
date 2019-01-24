<?php
namespace AliOpen\Core\Auth;

class RamRoleArnCredential extends AbstractCredential {
    /**
     * @var string
     */
    private $accessKeyId;
    /**
     * @var string
     */
    private $accessSecret;
    /**
     * @var string
     */
    private $roleArn;
    /**
     * @var string
     */
    private $roleSessionName;

    /**
     * AliOpen\Core\Auth\RamRoleArnCredential constructor.
     * @param $accessKeyId
     * @param $accessSecret
     * @param $roleArn
     * @param $roleSessionName
     */
    public function __construct($accessKeyId, $accessSecret, $roleArn, $roleSessionName){
        $this->accessKeyId = $accessKeyId;
        $this->accessSecret = $accessSecret;
        $this->roleArn = $roleArn;
        $this->roleSessionName = $roleSessionName;
    }

    /**
     * @return string
     */
    public function getAccessKeyId(){
        return $this->accessKeyId;
    }

    /**
     * @param $accessKeyId
     */
    public function setAccessKeyId($accessKeyId){
        $this->accessKeyId = $accessKeyId;
    }

    /**
     * @return string
     */
    public function getAccessSecret(){
        return $this->accessSecret;
    }

    /**
     * @param $accessSecret
     */
    public function setAccessSecret($accessSecret){
        $this->accessSecret = $accessSecret;
    }

    /**
     * @return string
     */
    public function getRoleArn(){
        return $this->roleArn;
    }

    /**
     * @param $roleArn
     */
    public function setRoleArn($roleArn){
        $this->roleArn = $roleArn;
    }

    /**
     * @return string
     */
    public function getRoleSessionName(){
        return $this->roleSessionName;
    }

    /**
     * @param $roleSessionName
     */
    public function setRoleSessionName($roleSessionName){
        $this->roleSessionName = $roleSessionName;
    }

    /**
     * @return null
     */
    public function getSecurityToken(){
        return null;
    }
}