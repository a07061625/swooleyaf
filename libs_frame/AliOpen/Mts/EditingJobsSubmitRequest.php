<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class EditingJobsSubmitRequest extends RpcAcsRequest {
    private $outputBucket;
    private $resourceOwnerId;
    private $editingJobOutputs;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $outputLocation;
    private $ownerId;
    private $editingInputs;
    private $pipelineId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SubmitEditingJobs", "mts", "openAPI");
        $this->setMethod("POST");
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

    public function getEditingJobOutputs(){
        return $this->editingJobOutputs;
    }

    public function setEditingJobOutputs($editingJobOutputs){
        $this->editingJobOutputs = $editingJobOutputs;
        $this->queryParameters["EditingJobOutputs"] = $editingJobOutputs;
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

    public function getEditingInputs(){
        return $this->editingInputs;
    }

    public function setEditingInputs($editingInputs){
        $this->editingInputs = $editingInputs;
        $this->queryParameters["EditingInputs"] = $editingInputs;
    }

    public function getPipelineId(){
        return $this->pipelineId;
    }

    public function setPipelineId($pipelineId){
        $this->pipelineId = $pipelineId;
        $this->queryParameters["PipelineId"] = $pipelineId;
    }
}