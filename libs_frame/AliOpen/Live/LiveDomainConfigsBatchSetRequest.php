<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDomainConfigsBatchSetRequest extends RpcAcsRequest {
    private $functions;
    private $securityToken;
    private $domainNames;
    private $ownerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "BatchSetLiveDomainConfigs", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getFunctions(){
        return $this->functions;
    }

    public function setFunctions($functions){
        $this->functions = $functions;
        $this->queryParameters["Functions"] = $functions;
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