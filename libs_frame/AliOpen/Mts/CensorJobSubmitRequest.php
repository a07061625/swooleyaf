<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class CensorJobSubmitRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $coverImages;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $description;
    private $ownerId;
    private $title;
    private $censorConfig;
    private $pipelineId;
    private $input;
    private $userData;
    private $barrages;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SubmitCensorJob", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getCoverImages(){
        return $this->coverImages;
    }

    public function setCoverImages($coverImages){
        $this->coverImages = $coverImages;
        $this->queryParameters["CoverImages"] = $coverImages;
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

    public function getCensorConfig(){
        return $this->censorConfig;
    }

    public function setCensorConfig($censorConfig){
        $this->censorConfig = $censorConfig;
        $this->queryParameters["CensorConfig"] = $censorConfig;
    }

    public function getPipelineId(){
        return $this->pipelineId;
    }

    public function setPipelineId($pipelineId){
        $this->pipelineId = $pipelineId;
        $this->queryParameters["PipelineId"] = $pipelineId;
    }

    public function getInput(){
        return $this->input;
    }

    public function setInput($input){
        $this->input = $input;
        $this->queryParameters["Input"] = $input;
    }

    public function getUserData(){
        return $this->userData;
    }

    public function setUserData($userData){
        $this->userData = $userData;
        $this->queryParameters["UserData"] = $userData;
    }

    public function getBarrages(){
        return $this->barrages;
    }

    public function setBarrages($barrages){
        $this->barrages = $barrages;
        $this->queryParameters["Barrages"] = $barrages;
    }
}