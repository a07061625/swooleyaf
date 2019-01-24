<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class ComplexJobSubmitRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $transcodeOutput;
    private $resourceOwnerAccount;
    private $inputs;
    private $ownerAccount;
    private $outputLocation;
    private $ownerId;
    private $pipelineId;
    private $outputBucket;
    private $userData;
    private $complexConfigs;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SubmitComplexJob", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getTranscodeOutput(){
        return $this->transcodeOutput;
    }

    public function setTranscodeOutput($transcodeOutput){
        $this->transcodeOutput = $transcodeOutput;
        $this->queryParameters["TranscodeOutput"] = $transcodeOutput;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getInputs(){
        return $this->inputs;
    }

    public function setInputs($inputs){
        $this->inputs = $inputs;
        $this->queryParameters["Inputs"] = $inputs;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getOutputLocation(){
        return $this->outputLocation;
    }

    public function setOutputLocation($outputLocation){
        $this->outputLocation = $outputLocation;
        $this->queryParameters["OutputLocation"] = $outputLocation;
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

    public function getOutputBucket(){
        return $this->outputBucket;
    }

    public function setOutputBucket($outputBucket){
        $this->outputBucket = $outputBucket;
        $this->queryParameters["OutputBucket"] = $outputBucket;
    }

    public function getUserData(){
        return $this->userData;
    }

    public function setUserData($userData){
        $this->userData = $userData;
        $this->queryParameters["UserData"] = $userData;
    }

    public function getComplexConfigs(){
        return $this->complexConfigs;
    }

    public function setComplexConfigs($complexConfigs){
        $this->complexConfigs = $complexConfigs;
        $this->queryParameters["ComplexConfigs"] = $complexConfigs;
    }
}