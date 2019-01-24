<?php
namespace AliOpen\Core\Auth;

class BearerTokenCredential extends AbstractCredential {
    /**
     * @var string
     */
    private $bearerToken;

    /**
     * AliOpen\Core\Auth\BearerTokenCredential constructor.
     * @param $bearerToken
     */
    public function __construct($bearerToken){
        $this->bearerToken = $bearerToken;
    }

    /**
     * @return null
     */
    public function getAccessKeyId(){
        return null;
    }

    /**
     * @return null
     */
    public function getAccessSecret(){
        return null;
    }

    /**
     * @return string
     */
    public function getBearerToken(){
        return $this->bearerToken;
    }

    /**
     * @param $bearerToken
     */
    public function setBearerToken($bearerToken){
        $this->bearerToken = $bearerToken;
    }

    /**
     * @return null
     */
    public function getSecurityToken(){
        return null;
    }
}