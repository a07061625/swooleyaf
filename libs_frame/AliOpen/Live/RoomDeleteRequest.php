<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class RoomDeleteRequest extends RpcAcsRequest {
    private $ownerId;
    private $roomId;
    private $appId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DeleteRoom", "live", "openAPI");
        $this->setMethod("POST");
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