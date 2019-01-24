<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class MediaDetailJobResultReportRequest extends RpcAcsRequest {
    private $jobId;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $tag;
    private $ownerId;
    private $results;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "ReportMediaDetailJobResult", "mts", "openAPI");
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

    public function getTag(){
        return $this->tag;
    }

    public function setTag($tag){
        $this->tag = $tag;
        $this->queryParameters["Tag"] = $tag;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getResults(){
        return $this->results;
    }

    public function setResults($results){
        $this->results = $results;
        $this->queryParameters["Results"] = $results;
    }
}