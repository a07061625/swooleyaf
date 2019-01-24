<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class SessionCreateRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $sessionTime;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $endUserId;
    private $ownerId;
    private $mediaId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "CreateSession", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getSessionTime(){
        return $this->sessionTime;
    }

    public function setSessionTime($sessionTime){
        $this->sessionTime = $sessionTime;
        $this->queryParameters["SessionTime"] = $sessionTime;
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

    public function getEndUserId(){
        return $this->endUserId;
    }

    public function setEndUserId($endUserId){
        $this->endUserId = $endUserId;
        $this->queryParameters["EndUserId"] = $endUserId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getMediaId(){
        return $this->mediaId;
    }

    public function setMediaId($mediaId){
        $this->mediaId = $mediaId;
        $this->queryParameters["MediaId"] = $mediaId;
    }
}