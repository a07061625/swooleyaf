<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDomainConfigsDescribeRequest extends RpcAcsRequest {
    private $functionNames;
    private $securityToken;
    private $domainName;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveDomainConfigs", "live", "openAPI");
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