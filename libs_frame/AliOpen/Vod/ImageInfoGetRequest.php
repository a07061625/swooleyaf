<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class ImageInfoGetRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $imageId;
    private $resourceOwnerAccount;
    private $ownerId;
    private $authTimeout;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "GetImageInfo", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getImageId(){
        return $this->imageId;
    }

    public function setImageId($imageId){
        $this->imageId = $imageId;
        $this->queryParameters["ImageId"] = $imageId;
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

    public function getAuthTimeout(){
        return $this->authTimeout;
    }

    public function setAuthTimeout($authTimeout){
        $this->authTimeout = $authTimeout;
        $this->queryParameters["AuthTimeout"] = $authTimeout;
    }
}