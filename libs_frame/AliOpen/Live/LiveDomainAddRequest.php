<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDomainAddRequest extends RpcAcsRequest {
    private $topLevelDomain;
    private $securityToken;
    private $ownerAccount;
    private $scope;
    private $domainName;
    private $ownerId;
    private $region;
    private $checkUrl;
    private $liveDomainType;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddLiveDomain", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getTopLevelDomain(){
        return $this->topLevelDomain;
    }

    public function setTopLevelDomain($topLevelDomain){
        $this->topLevelDomain = $topLevelDomain;
        $this->queryParameters["TopLevelDomain"] = $topLevelDomain;
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getScope(){
        return $this->scope;
    }

    public function setScope($scope){
        $this->scope = $scope;
        $this->queryParameters["Scope"] = $scope;
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

    public function getRegion(){
        return $this->region;
    }

    public function setRegion($region){
        $this->region = $region;
        $this->queryParameters["Region"] = $region;
    }

    public function getCheckUrl(){
        return $this->checkUrl;
    }

    public function setCheckUrl($checkUrl){
        $this->checkUrl = $checkUrl;
        $this->queryParameters["CheckUrl"] = $checkUrl;
    }

    public function getLiveDomainType(){
        return $this->liveDomainType;
    }

    public function setLiveDomainType($liveDomainType){
        $this->liveDomainType = $liveDomainType;
        $this->queryParameters["LiveDomainType"] = $liveDomainType;
    }
}