<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class SubtitleJobSubmitRequest extends RpcAcsRequest {
    private $userData;
    private $resourceOwnerId;
    private $outputConfig;
    private $inputConfig;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $ownerId;
    private $pipelineId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SubmitSubtitleJob", "mts", "openAPI");
        $this->setMethod("POST");
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

    public function getOutputConfig(){
        return $this->outputConfig;
    }

    public function setOutputConfig($outputConfig){
        $this->outputConfig = $outputConfig;
        $this->queryParameters["OutputConfig"] = $outputConfig;
    }

    public function getInputConfig(){
        return $this->inputConfig;
    }

    public function setInputConfig($inputConfig){
        $this->inputConfig = $inputConfig;
        $this->queryParameters["InputConfig"] = $inputConfig;
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