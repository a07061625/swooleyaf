<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class PornJobResultReportRequest extends RpcAcsRequest {
    private $jobId;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $label;
    private $detail;
    private $ownerId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "ReportPornJobResult", "mts", "openAPI");
        $this->setMethod("POST");
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

    public function getLabel(){
        return $this->label;
    }

    public function setLabel($label){
        $this->label = $label;
        $this->queryParameters["Label"] = $label;
    }

    public function getDetail(){
        return $this->detail;
    }

    public function setDetail($detail){
        $this->detail = $detail;
        $this->queryParameters["Detail"] = $detail;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}