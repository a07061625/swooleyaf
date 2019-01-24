<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class MediaSearchRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $description;
    private $ownerId;
    private $title;
    private $pageNumber;
    private $cateId;
    private $pageSize;
    private $from;
    private $sortBy;
    private $to;
    private $tag;
    private $keyWord;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SearchMedia", "mts", "openAPI");
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

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
        $this->queryParameters["Description"] = $description;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        $this->queryParameters["Title"] = $title;
    }

    public function getPageNumber(){
        return $this->pageNumber;
    }

    public function setPageNumber($pageNumber){
        $this->pageNumber = $pageNumber;
        $this->queryParameters["PageNumber"] = $pageNumber;
    }

    public function getCateId(){
        return $this->cateId;
    }

    public function setCateId($cateId){
        $this->cateId = $cateId;
        $this->queryParameters["CateId"] = $cateId;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getFrom(){
        return $this->from;
    }

    public function setFrom($from){
        $this->from = $from;
        $this->queryParameters["From"] = $from;
    }

    public function getSortBy(){
        return $this->sortBy;
    }

    public function setSortBy($sortBy){
        $this->sortBy = $sortBy;
        $this->queryParameters["SortBy"] = $sortBy;
    }

    public function getTo(){
        return $this->to;
    }

    public function setTo($to){
        $this->to = $to;
        $this->queryParameters["To"] = $to;
    }

    public function getTag(){
        return $this->tag;
    }

    public function setTag($tag){
        $this->tag = $tag;
        $this->queryParameters["Tag"] = $tag;
    }

    public function getKeyWord(){
        return $this->keyWord;
    }

    public function setKeyWord($keyWord){
        $this->keyWord = $keyWord;
        $this->queryParameters["KeyWord"] = $keyWord;
    }
}