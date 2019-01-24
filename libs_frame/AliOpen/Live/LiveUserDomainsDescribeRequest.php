<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveUserDomainsDescribeRequest extends RpcAcsRequest {
    private $securityToken;
    private $pageSize;
    private $domainName;
    private $regionName;
    private $ownerId;
    private $pageNumber;
    private $domainStatus;
    private $liveDomainType;
    private $domainSearchType;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveUserDomains", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getRegionName(){
        return $this->regionName;
    }

    public function setRegionName($regionName){
        $this->regionName = $regionName;
        $this->queryParameters["RegionName"] = $regionName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPageNumber(){
        return $this->pageNumber;
    }

    public function setPageNumber($pageNumber){
        $this->pageNumber = $pageNumber;
        $this->queryParameters["PageNumber"] = $pageNumber;
    }

    public function getDomainStatus(){
        return $this->domainStatus;
    }

    public function setDomainStatus($domainStatus){
        $this->domainStatus = $domainStatus;
        $this->queryParameters["DomainStatus"] = $domainStatus;
    }

    public function getLiveDomainType(){
        return $this->liveDomainType;
    }

    public function setLiveDomainType($liveDomainType){
        $this->liveDomainType = $liveDomainType;
        $this->queryParameters["LiveDomainType"] = $liveDomainType;
    }

    public function getDomainSearchType(){
        return $this->domainSearchType;
    }

    public function setDomainSearchType($domainSearchType){
        $this->domainSearchType = $domainSearchType;
        $this->queryParameters["DomainSearchType"] = $domainSearchType;
    }
}