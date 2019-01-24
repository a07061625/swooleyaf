<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class JobListRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $nextPageToken;
    private $startOfJobCreatedTimeRange;
    private $ownerAccount;
    private $maximumPageSize;
    private $state;
    private $ownerId;
    private $endOfJobCreatedTimeRange;
    private $pipelineId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "ListJob", "mts", "openAPI");
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

    public function getNextPageToken(){
        return $this->nextPageToken;
    }

    public function setNextPageToken($nextPageToken){
        $this->nextPageToken = $nextPageToken;
        $this->queryParameters["NextPageToken"] = $nextPageToken;
    }

    public function getStartOfJobCreatedTimeRange(){
        return $this->startOfJobCreatedTimeRange;
    }

    public function setStartOfJobCreatedTimeRange($startOfJobCreatedTimeRange){
        $this->startOfJobCreatedTimeRange = $startOfJobCreatedTimeRange;
        $this->queryParameters["StartOfJobCreatedTimeRange"] = $startOfJobCreatedTimeRange;
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

    public function getEndOfJobCreatedTimeRange(){
        return $this->endOfJobCreatedTimeRange;
    }

    public function setEndOfJobCreatedTimeRange($endOfJobCreatedTimeRange){
        $this->endOfJobCreatedTimeRange = $endOfJobCreatedTimeRange;
        $this->queryParameters["EndOfJobCreatedTimeRange"] = $endOfJobCreatedTimeRange;
    }

    public function getPipelineId(){
        return $this->pipelineId;
    }

    public function setPipelineId($pipelineId){
        $this->pipelineId = $pipelineId;
        $this->queryParameters["PipelineId"] = $pipelineId;
    }
}