<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDomainConfigsBatchDeleteRequest extends RpcAcsRequest {
    private $functionNames;
    private $securityToken;
    private $domainNames;
    private $ownerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "BatchDeleteLiveDomainConfigs", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getFunctionNames(){
        return $this->functionNames;
    }

    public function setFunctionNames($functionNames){
        $this->functionNames = $functionNames;
        $this->queryParameters["FunctionNames"] = $functionNames;
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getDomainNames(){
        return $this->domainNames;
    }

    public function setDomainNames($domainNames){
        $this->domainNames = $domainNames;
        $this->queryParameters["DomainNames"] = $domainNames;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}