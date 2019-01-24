<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class WatermarkUpdateRequest extends RpcAcsRequest {
    private $watermarkId;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $name;
    private $ownerId;
    private $watermarkConfig;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "UpdateWatermark", "vod", "openAPI");
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

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        $this->queryParameters["Name"] = $name;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getWatermarkConfig(){
        return $this->watermarkConfig;
    }

    public function setWatermarkConfig($watermarkConfig){
        $this->watermarkConfig = $watermarkConfig;
        $this->queryParameters["WatermarkConfig"] = $watermarkConfig;
    }
}