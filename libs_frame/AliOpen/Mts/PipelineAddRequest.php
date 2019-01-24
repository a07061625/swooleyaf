<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class PipelineAddRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $role;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $name;
    private $notifyConfig;
    private $ownerId;
    private $speedLevel;
    private $speed;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "AddPipeline", "mts", "openAPI");
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

    public function getSpeedLevel(){
        return $this->speedLevel;
    }

    public function setSpeedLevel($speedLevel){
        $this->speedLevel = $speedLevel;
        $this->queryParameters["SpeedLevel"] = $speedLevel;
    }

    public function getSpeed(){
        return $this->speed;
    }

    public function setSpeed($speed){
        $this->speed = $speed;
        $this->queryParameters["Speed"] = $speed;
    }
}