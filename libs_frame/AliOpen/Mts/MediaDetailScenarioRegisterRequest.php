<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class MediaDetailScenarioRegisterRequest extends RpcAcsRequest {
    private $jobId;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $scenario;
    private $ownerAccount;
    private $description;
    private $ownerId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "RegisterMediaDetailScenario", "mts", "openAPI");
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

    public function getScenario(){
        return $this->scenario;
    }

    public function setScenario($scenario){
        $this->scenario = $scenario;
        $this->queryParameters["Scenario"] = $scenario;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
        $this->queryParameters["Description"] = $description;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}