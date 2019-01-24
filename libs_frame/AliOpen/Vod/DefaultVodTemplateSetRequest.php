<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class DefaultVodTemplateSetRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $vodTemplateId;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "SetDefaultVodTemplate", "vod", "openAPI");
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