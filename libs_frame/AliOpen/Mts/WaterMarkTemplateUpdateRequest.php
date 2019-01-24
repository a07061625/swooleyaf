<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class WaterMarkTemplateUpdateRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $name;
    private $ownerId;
    private $waterMarkTemplateId;
    private $config;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "UpdateWaterMarkTemplate", "mts", "openAPI");
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

    public function getWaterMarkTemplateId(){
        return $this->waterMarkTemplateId;
    }

    public function setWaterMarkTemplateId($waterMarkTemplateId){
        $this->waterMarkTemplateId = $waterMarkTemplateId;
        $this->queryParameters["WaterMarkTemplateId"] = $waterMarkTemplateId;
    }

    public function getConfig(){
        return $this->config;
    }

    public function setConfig($config){
        $this->config = $config;
        $this->queryParameters["Config"] = $config;
    }
}