<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class CategoriesGetRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $cateId;
    private $pageNo;
    private $pageSize;
    private $sortBy;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "GetCategories", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getCateId(){
        return $this->cateId;
    }

    public function setCateId($cateId){
        $this->cateId = $cateId;
        $this->queryParameters["CateId"] = $cateId;
    }

    public function getPageNo(){
        return $this->pageNo;
    }

    public function setPageNo($pageNo){
        $this->pageNo = $pageNo;
        $this->queryParameters["PageNo"] = $pageNo;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getSortBy(){
        return $this->sortBy;
    }

    public function setSortBy($sortBy){
        $this->sortBy = $sortBy;
        $this->queryParameters["SortBy"] = $sortBy;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}