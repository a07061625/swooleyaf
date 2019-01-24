<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

class SigAuthenticateRequest extends RpcAcsRequest {
    private $sig;
    private $resourceOwnerId;
    private $remoteIp;
    private $sourceIp;
    private $appKey;
    private $sessionId;
    private $token;
    private $scene;

    public function __construct(){
        parent::__construct("afs", "2018-01-12", "AuthenticateSig");
        $this->setMethod("POST");
    }

    public function getSig(){
        return $this->sig;
    }

    public function setSig($sig){
        $this->sig = $sig;
        $this->queryParameters["Sig"] = $sig;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getRemoteIp(){
        return $this->remoteIp;
    }

    public function setRemoteIp($remoteIp){
        $this->remoteIp = $remoteIp;
        $this->queryParameters["RemoteIp"] = $remoteIp;
    }

    public function getSourceIp(){
        return $this->sourceIp;
    }

    public function setSourceIp($sourceIp){
        $this->sourceIp = $sourceIp;
        $this->queryParameters["SourceIp"] = $sourceIp;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }

    public function getSessionId(){
        return $this->sessionId;
    }

    public function setSessionId($sessionId){
        $this->sessionId = $sessionId;
        $this->queryParameters["SessionId"] = $sessionId;
    }

    public function getToken(){
        return $this->token;
    }

    public function setToken($token){
        $this->token = $token;
        $this->queryParameters["Token"] = $token;
    }

    public function getScene(){
        return $this->scene;
    }

    public function setScene($scene){
        $this->scene = $scene;
        $this->queryParameters["Scene"] = $scene;
    }
}