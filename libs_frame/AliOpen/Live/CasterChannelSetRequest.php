<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterChannelSetRequest extends RpcAcsRequest {
    private $resourceId;
    private $playStatus;
    private $casterId;
    private $ownerId;
    private $seekOffset;
    private $channelId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "SetCasterChannel", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceId(){
        return $this->resourceId;
    }

    public function setResourceId($resourceId){
        $this->resourceId = $resourceId;
        $this->queryParameters["ResourceId"] = $resourceId;
    }

    public function getPlayStatus(){
        return $this->playStatus;
    }

    public function setPlayStatus($playStatus){
        $this->playStatus = $playStatus;
        $this->queryParameters["PlayStatus"] = $playStatus;
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getSeekOffset(){
        return $this->seekOffset;
    }

    public function setSeekOffset($seekOffset){
        $this->seekOffset = $seekOffset;
        $this->queryParameters["SeekOffset"] = $seekOffset;
    }

    public function getChannelId(){
        return $this->channelId;
    }

    public function setChannelId($channelId){
        $this->channelId = $channelId;
        $this->queryParameters["ChannelId"] = $channelId;
    }
}