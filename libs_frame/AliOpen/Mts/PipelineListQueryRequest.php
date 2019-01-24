<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class PipelineListQueryRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $pipelineIds;
    private $ownerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "QueryPipelineList", "mts", "openAPI");
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

    public function getPipelineIds(){
        return $this->pipelineIds;
    }

    public function setPipelineIds($pipelineIds){
        $this->pipelineIds = $pipelineIds;
        $this->queryParameters["PipelineIds"] = $pipelineIds;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}