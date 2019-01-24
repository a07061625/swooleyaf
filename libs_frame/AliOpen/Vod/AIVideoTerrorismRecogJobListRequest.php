<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class AIVideoTerrorismRecogJobListRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $aIVideoTerrorismRecogJobIds;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "ListAIVideoTerrorismRecogJob", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getAIVideoTerrorismRecogJobIds(){
        return $this->aIVideoTerrorismRecogJobIds;
    }

    public function setAIVideoTerrorismRecogJobIds($aIVideoTerrorismRecogJobIds){
        $this->aIVideoTerrorismRecogJobIds = $aIVideoTerrorismRecogJobIds;
        $this->queryParameters["AIVideoTerrorismRecogJobIds"] = $aIVideoTerrorismRecogJobIds;
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

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}