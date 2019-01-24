<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class CoverPipelineAddRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $role;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $name;
    private $notifyConfig;
    private $ownerId;
    private $priority;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "AddCoverPipeline", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
        $this->queryParameters["Role"] = $role;
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

    public function getNotifyConfig(){
        return $this->notifyConfig;
    }

    public function setNotifyConfig($notifyConfig){
        $this->notifyConfig = $notifyConfig;
        $this->queryParameters["NotifyConfig"] = $notifyConfig;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPriority(){
        return $this->priority;
    }

    public function setPriority($priority){
        $this->priority = $priority;
        $this->queryParameters["Priority"] = $priority;
    }
}