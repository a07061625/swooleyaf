<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDomainMappingAddRequest extends RpcAcsRequest {
    private $pullDomain;
    private $securityToken;
    private $pushDomain;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddLiveDomainMapping", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getPullDomain(){
        return $this->pullDomain;
    }

    public function setPullDomain($pullDomain){
        $this->pullDomain = $pullDomain;
        $this->queryParameters["PullDomain"] = $pullDomain;
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getPushDomain(){
        return $this->pushDomain;
    }

    public function setPushDomain($pushDomain){
        $this->pushDomain = $pushDomain;
        $this->queryParameters["PushDomain"] = $pushDomain;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}