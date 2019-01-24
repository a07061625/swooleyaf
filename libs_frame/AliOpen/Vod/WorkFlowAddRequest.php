<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class WorkFlowAddRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $name;
    private $actionList;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "AddWorkFlow", "vod", "openAPI");
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

    public function getActionList(){
        return $this->actionList;
    }

    public function setActionList($actionList){
        $this->actionList = $actionList;
        $this->queryParameters["ActionList"] = $actionList;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}