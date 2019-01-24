<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class AIVideoCensorJobSubmitRequest extends RpcAcsRequest {
    private $userData;
    private $resourceOwnerId;
    private $aIVideoCensorConfig;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $ownerId;
    private $mediaId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "SubmitAIVideoCensorJob", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getUserData(){
        return $this->userData;
    }

    public function setUserData($userData){
        $this->userData = $userData;
        $this->queryParameters["UserData"] = $userData;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getAIVideoCensorConfig(){
        return $this->aIVideoCensorConfig;
    }

    public function setAIVideoCensorConfig($aIVideoCensorConfig){
        $this->aIVideoCensorConfig = $aIVideoCensorConfig;
        $this->queryParameters["AIVideoCensorConfig"] = $aIVideoCensorConfig;
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

    public function getMediaId(){
        return $this->mediaId;
    }

    public function setMediaId($mediaId){
        $this->mediaId = $mediaId;
        $this->queryParameters["MediaId"] = $mediaId;
    }
}