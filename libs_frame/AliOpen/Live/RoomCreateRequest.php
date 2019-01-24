<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class RoomCreateRequest extends RpcAcsRequest {
    private $anchorId;
    private $ownerId;
    private $roomId;
    private $appId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "CreateRoom", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getAnchorId(){
        return $this->anchorId;
    }

    public function setAnchorId($anchorId){
        $this->anchorId = $anchorId;
        $this->queryParameters["AnchorId"] = $anchorId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getRoomId(){
        return $this->roomId;
    }

    public function setRoomId($roomId){
        $this->roomId = $roomId;
        $this->queryParameters["RoomId"] = $roomId;
    }

    public function getAppId(){
        return $this->appId;
    }

    public function setAppId($appId){
        $this->appId = $appId;
        $this->queryParameters["AppId"] = $appId;
    }
}