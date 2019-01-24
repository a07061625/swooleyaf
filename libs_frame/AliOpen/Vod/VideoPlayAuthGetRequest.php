<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class VideoPlayAuthGetRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $reAuthInfo;
    private $playConfig;
    private $authInfoTimeout;
    private $videoId;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "GetVideoPlayAuth", "vod", "openAPI");
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

    public function getReAuthInfo(){
        return $this->reAuthInfo;
    }

    public function setReAuthInfo($reAuthInfo){
        $this->reAuthInfo = $reAuthInfo;
        $this->queryParameters["ReAuthInfo"] = $reAuthInfo;
    }

    public function getPlayConfig(){
        return $this->playConfig;
    }

    public function setPlayConfig($playConfig){
        $this->playConfig = $playConfig;
        $this->queryParameters["PlayConfig"] = $playConfig;
    }

    public function getAuthInfoTimeout(){
        return $this->authInfoTimeout;
    }

    public function setAuthInfoTimeout($authInfoTimeout){
        $this->authInfoTimeout = $authInfoTimeout;
        $this->queryParameters["AuthInfoTimeout"] = $authInfoTimeout;
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
}