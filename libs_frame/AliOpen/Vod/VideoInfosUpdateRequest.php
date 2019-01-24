<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class VideoInfosUpdateRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $updateContent;
    private $resourceOwnerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "UpdateVideoInfos", "vod", "openAPI");
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

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}