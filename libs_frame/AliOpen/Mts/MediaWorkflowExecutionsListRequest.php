<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class MediaWorkflowExecutionsListRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $inputFileURL;
    private $nextPageToken;
    private $ownerAccount;
    private $maximumPageSize;
    private $mediaWorkflowId;
    private $ownerId;
    private $mediaWorkflowName;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "ListMediaWorkflowExecutions", "mts", "openAPI");
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

    public function getInputFileURL(){
        return $this->inputFileURL;
    }

    public function setInputFileURL($inputFileURL){
        $this->inputFileURL = $inputFileURL;
        $this->queryParameters["InputFileURL"] = $inputFileURL;
    }

    public function getNextPageToken(){
        return $this->nextPageToken;
    }

    public function setNextPageToken($nextPageToken){
        $this->nextPageToken = $nextPageToken;
        $this->queryParameters["NextPageToken"] = $nextPageToken;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getMaximumPageSize(){
        return $this->maximumPageSize;
    }

    public function setMaximumPageSize($maximumPageSize){
        $this->maximumPageSize = $maximumPageSize;
        $this->queryParameters["MaximumPageSize"] = $maximumPageSize;
    }

    public function getMediaWorkflowId(){
        return $this->mediaWorkflowId;
    }

    public function setMediaWorkflowId($mediaWorkflowId){
        $this->mediaWorkflowId = $mediaWorkflowId;
        $this->queryParameters["MediaWorkflowId"] = $mediaWorkflowId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getMediaWorkflowName(){
        return $this->mediaWorkflowName;
    }

    public function setMediaWorkflowName($mediaWorkflowName){
        $this->mediaWorkflowName = $mediaWorkflowName;
        $this->queryParameters["MediaWorkflowName"] = $mediaWorkflowName;
    }
}