<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class TemplateSearchRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $pageSize;
    private $state;
    private $ownerId;
    private $pageNumber;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SearchTemplate", "mts", "openAPI");
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

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getState(){
        return $this->state;
    }

    public function setState($state){
        $this->state = $state;
        $this->queryParameters["State"] = $state;
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
}