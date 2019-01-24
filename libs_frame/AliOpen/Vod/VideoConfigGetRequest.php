<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class VideoConfigGetRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $videoId;
    private $ownerId;
    private $authInfo;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "GetVideoConfig", "vod", "openAPI");
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

    public function getVideoId(){
        return $this->videoId;
    }

    public function setVideoId($videoId){
        $this->videoId = $videoId;
        $this->queryParameters["VideoId"] = $videoId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getAuthInfo(){
        return $this->authInfo;
    }

    public function setAuthInfo($authInfo){
        $this->authInfo = $authInfo;
        $this->queryParameters["AuthInfo"] = $authInfo;
    }
}