<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class VideoPlayInfoGetRequest extends RpcAcsRequest {
    private $signVersion;
    private $resourceOwnerId;
    private $clientVersion;
    private $resourceOwnerAccount;
    private $channel;
    private $playSign;
    private $videoId;
    private $ownerId;
    private $clientTS;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "GetVideoPlayInfo", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getSignVersion(){
        return $this->signVersion;
    }

    public function setSignVersion($signVersion){
        $this->signVersion = $signVersion;
        $this->queryParameters["SignVersion"] = $signVersion;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getClientVersion(){
        return $this->clientVersion;
    }

    public function setClientVersion($clientVersion){
        $this->clientVersion = $clientVersion;
        $this->queryParameters["ClientVersion"] = $clientVersion;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getChannel(){
        return $this->channel;
    }

    public function setChannel($channel){
        $this->channel = $channel;
        $this->queryParameters["Channel"] = $channel;
    }

    public function getPlaySign(){
        return $this->playSign;
    }

    public function setPlaySign($playSign){
        $this->playSign = $playSign;
        $this->queryParameters["PlaySign"] = $playSign;
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

    public function getClientTS(){
        return $this->clientTS;
    }

    public function setClientTS($clientTS){
        $this->clientTS = $clientTS;
        $this->queryParameters["ClientTS"] = $clientTS;
    }
}