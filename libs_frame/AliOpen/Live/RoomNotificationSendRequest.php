<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class RoomNotificationSendRequest extends RpcAcsRequest {
    private $data;
    private $appUid;
    private $ownerId;
    private $priority;
    private $roomId;
    private $appId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "SendRoomNotification", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
        $this->queryParameters["Data"] = $data;
    }

    public function getAppUid(){
        return $this->appUid;
    }

    public function setAppUid($appUid){
        $this->appUid = $appUid;
        $this->queryParameters["AppUid"] = $appUid;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPriority(){
        return $this->priority;
    }

    public function setPriority($priority){
        $this->priority = $priority;
        $this->queryParameters["Priority"] = $priority;
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