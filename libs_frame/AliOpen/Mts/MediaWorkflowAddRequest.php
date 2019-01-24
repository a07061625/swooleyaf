<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class MediaWorkflowAddRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $topology;
    private $ownerAccount;
    private $name;
    private $ownerId;
    private $triggerMode;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "AddMediaWorkflow", "mts", "openAPI");
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

    public function getTopology(){
        return $this->topology;
    }

    public function setTopology($topology){
        $this->topology = $topology;
        $this->queryParameters["Topology"] = $topology;
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

    public function getTriggerMode(){
        return $this->triggerMode;
    }

    public function setTriggerMode($triggerMode){
        $this->triggerMode = $triggerMode;
        $this->queryParameters["TriggerMode"] = $triggerMode;
    }
}