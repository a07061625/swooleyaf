<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class EditingProjectMaterialsSetRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $materialIds;
    private $ownerId;
    private $projectId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "SetEditingProjectMaterials", "vod", "openAPI");
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

    public function getMaterialIds(){
        return $this->materialIds;
    }

    public function setMaterialIds($materialIds){
        $this->materialIds = $materialIds;
        $this->queryParameters["MaterialIds"] = $materialIds;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getProjectId(){
        return $this->projectId;
    }

    public function setProjectId($projectId){
        $this->projectId = $projectId;
        $this->queryParameters["ProjectId"] = $projectId;
    }
}