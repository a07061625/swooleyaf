<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class CoverJobSubmitRequest extends RpcAcsRequest {
    private $input;
    private $userData;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $coverConfig;
    private $ownerId;
    private $pipelineId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SubmitCoverJob", "mts", "openAPI");
        $this->setMethod("POST");
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

    public function getCoverConfig(){
        return $this->coverConfig;
    }

    public function setCoverConfig($coverConfig){
        $this->coverConfig = $coverConfig;
        $this->queryParameters["CoverConfig"] = $coverConfig;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPipelineId(){
        return $this->pipelineId;
    }

    public function setPipelineId($pipelineId){
        $this->pipelineId = $pipelineId;
        $this->queryParameters["PipelineId"] = $pipelineId;
    }
}