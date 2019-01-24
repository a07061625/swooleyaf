<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class VodTemplateUpdateRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $templateConfig;
    private $name;
    private $vodTemplateId;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "UpdateVodTemplate", "vod", "openAPI");
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

    public function getTemplateConfig(){
        return $this->templateConfig;
    }

    public function setTemplateConfig($templateConfig){
        $this->templateConfig = $templateConfig;
        $this->queryParameters["TemplateConfig"] = $templateConfig;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        $this->queryParameters["Name"] = $name;
    }

    public function getVodTemplateId(){
        return $this->vodTemplateId;
    }

    public function setVodTemplateId($vodTemplateId){
        $this->vodTemplateId = $vodTemplateId;
        $this->queryParameters["VodTemplateId"] = $vodTemplateId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}