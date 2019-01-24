<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class VideoSplitJobResultReportRequest extends RpcAcsRequest {
    private $result;
    private $jobId;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $details;
    private $ownerId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "ReportVideoSplitJobResult", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getResult(){
        return $this->result;
    }

    public function setResult($result){
        $this->result = $result;
        $this->queryParameters["Result"] = $result;
    }

    public function getJobId(){
        return $this->jobId;
    }

    public function setJobId($jobId){
        $this->jobId = $jobId;
        $this->queryParameters["JobId"] = $jobId;
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

    public function getDetails(){
        return $this->details;
    }

    public function setDetails($details){
        $this->details = $details;
        $this->queryParameters["Details"] = $details;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}