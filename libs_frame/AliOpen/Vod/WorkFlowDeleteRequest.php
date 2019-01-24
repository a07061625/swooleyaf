<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class WorkFlowDeleteRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerId;
    private $workFlowId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "DeleteWorkFlow", "vod", "openAPI");
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

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getWorkFlowId(){
        return $this->workFlowId;
    }

    public function setWorkFlowId($workFlowId){
        $this->workFlowId = $workFlowId;
        $this->queryParameters["WorkFlowId"] = $workFlowId;
    }
}