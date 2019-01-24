<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class WatermarkAddRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $name;
    private $fileUrl;
    private $ownerId;
    private $type;
    private $watermarkConfig;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "AddWatermark", "vod", "openAPI");
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

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        $this->queryParameters["Name"] = $name;
    }

    public function getFileUrl(){
        return $this->fileUrl;
    }

    public function setFileUrl($fileUrl){
        $this->fileUrl = $fileUrl;
        $this->queryParameters["FileUrl"] = $fileUrl;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
        $this->queryParameters["Type"] = $type;
    }

    public function getWatermarkConfig(){
        return $this->watermarkConfig;
    }

    public function setWatermarkConfig($watermarkConfig){
        $this->watermarkConfig = $watermarkConfig;
        $this->queryParameters["WatermarkConfig"] = $watermarkConfig;
    }
}