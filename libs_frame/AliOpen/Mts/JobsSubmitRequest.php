<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class JobsSubmitRequest extends RpcAcsRequest {
    private $outputs;
    private $input;
    private $outputBucket;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $outputLocation;
    private $ownerId;
    private $pipelineId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SubmitJobs", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getOutputs(){
        return $this->outputs;
    }

    public function setOutputs($outputs){
        $this->outputs = $outputs;
        $this->queryParameters["Outputs"] = $outputs;
    }

    public function getInput(){
        return $this->input;
    }

    public function setInput($input){
        $this->input = $input;
        $this->queryParameters["Input"] = $input;
    }

    public function getOutputBucket(){
        return $this->outputBucket;
    }

    public function setOutputBucket($outputBucket){
        $this->outputBucket = $outputBucket;
        $this->queryParameters["OutputBucket"] = $outputBucket;
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
}