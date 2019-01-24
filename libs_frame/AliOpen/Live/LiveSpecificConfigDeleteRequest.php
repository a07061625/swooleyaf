<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveSpecificConfigDeleteRequest extends RpcAcsRequest {
    private $securityToken;
    private $configId;
    private $domainName;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DeleteLiveSpecificConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getConfigId(){
        return $this->configId;
    }

    public function setConfigId($configId){
        $this->configId = $configId;
        $this->queryParameters["ConfigId"] = $configId;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}