<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class ObjectCachesRefreshRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $objectPath;
    private $ownerId;
    private $objectType;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "RefreshObjectCaches", "vod", "openAPI");
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

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getObjectPath(){
        return $this->objectPath;
    }

    public function setObjectPath($objectPath){
        $this->objectPath = $objectPath;
        $this->queryParameters["ObjectPath"] = $objectPath;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getObjectType(){
        return $this->objectType;
    }

    public function setObjectType($objectType){
        $this->objectType = $objectType;
        $this->queryParameters["ObjectType"] = $objectType;
    }
}