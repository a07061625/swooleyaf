<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class EditingProjectAddRequest extends RpcAcsRequest {
    private $coverURL;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $description;
    private $timeline;
    private $ownerId;
    private $title;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "AddEditingProject", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getCoverURL(){
        return $this->coverURL;
    }

    public function setCoverURL($coverURL){
        $this->coverURL = $coverURL;
        $this->queryParameters["CoverURL"] = $coverURL;
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

    public function getTimeline(){
        return $this->timeline;
    }

    public function setTimeline($timeline){
        $this->timeline = $timeline;
        $this->queryParameters["Timeline"] = $timeline;
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
}