<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class AIVideoCategoryJobListRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $aIVideoCategoryJobIds;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "ListAIVideoCategoryJob", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getAIVideoCategoryJobIds(){
        return $this->aIVideoCategoryJobIds;
    }

    public function setAIVideoCategoryJobIds($aIVideoCategoryJobIds){
        $this->aIVideoCategoryJobIds = $aIVideoCategoryJobIds;
        $this->queryParameters["AIVideoCategoryJobIds"] = $aIVideoCategoryJobIds;
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