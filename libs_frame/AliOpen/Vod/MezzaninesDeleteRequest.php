<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class MezzaninesDeleteRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $force;
    private $ownerId;
    private $videoIds;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "DeleteMezzanines", "vod", "openAPI");
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

    public function getForce(){
        return $this->force;
    }

    public function setForce($force){
        $this->force = $force;
        $this->queryParameters["Force"] = $force;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getVideoIds(){
        return $this->videoIds;
    }

    public function setVideoIds($videoIds){
        $this->videoIds = $videoIds;
        $this->queryParameters["VideoIds"] = $videoIds;
    }
}