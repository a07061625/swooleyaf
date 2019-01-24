<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class DefaultWatermarkSetRequest extends RpcAcsRequest {
    private $watermarkId;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "SetDefaultWatermark", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getWatermarkId(){
        return $this->watermarkId;
    }

    public function setWatermarkId($watermarkId){
        $this->watermarkId = $watermarkId;
        $this->queryParameters["WatermarkId"] = $watermarkId;
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
}