<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class MediaRegisterRequest extends RpcAcsRequest {
    private $userData;
    private $resourceOwnerId;
    private $templateGroupId;
    private $resourceOwnerAccount;
    private $ownerId;
    private $registerMetadatas;
    private $workFlowId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "RegisterMedia", "vod", "openAPI");
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

    public function getTemplateGroupId(){
        return $this->templateGroupId;
    }

    public function setTemplateGroupId($templateGroupId){
        $this->templateGroupId = $templateGroupId;
        $this->queryParameters["TemplateGroupId"] = $templateGroupId;
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

    public function getRegisterMetadatas(){
        return $this->registerMetadatas;
    }

    public function setRegisterMetadatas($registerMetadatas){
        $this->registerMetadatas = $registerMetadatas;
        $this->queryParameters["RegisterMetadatas"] = $registerMetadatas;
    }

    public function getWorkFlowId(){
        return $this->workFlowId;
    }

    public function setWorkFlowId($workFlowId){
        $this->workFlowId = $workFlowId;
        $this->queryParameters["WorkFlowId"] = $workFlowId;
    }
}