<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class ImageInfosUpdateRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $updateContent;
    private $resourceOwnerAccount;
    private $resourceRealOwnerId;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "UpdateImageInfos", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getUpdateContent(){
        return $this->updateContent;
    }

    public function setUpdateContent($updateContent){
        $this->updateContent = $updateContent;
        $this->queryParameters["UpdateContent"] = $updateContent;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getResourceRealOwnerId(){
        return $this->resourceRealOwnerId;
    }

    public function setResourceRealOwnerId($resourceRealOwnerId){
        $this->resourceRealOwnerId = $resourceRealOwnerId;
        $this->queryParameters["ResourceRealOwnerId"] = $resourceRealOwnerId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}