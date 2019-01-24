<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveSnapshotConfigDescribeRequest extends RpcAcsRequest {
    private $appName;
    private $securityToken;
    private $domainName;
    private $pageSize;
    private $ownerId;
    private $pageNum;
    private $order;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveSnapshotConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
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

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPageNum(){
        return $this->pageNum;
    }

    public function setPageNum($pageNum){
        $this->pageNum = $pageNum;
        $this->queryParameters["PageNum"] = $pageNum;
    }

    public function getOrder(){
        return $this->order;
    }

    public function setOrder($order){
        $this->order = $order;
        $this->queryParameters["Order"] = $order;
    }
}