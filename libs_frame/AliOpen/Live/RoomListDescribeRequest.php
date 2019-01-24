<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class RoomListDescribeRequest extends RpcAcsRequest {
    private $startTime;
    private $anchorId;
    private $pageNum;
    private $roomStatus;
    private $pageSize;
    private $order;
    private $endTime;
    private $ownerId;
    private $roomId;
    private $appId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeRoomList", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getAnchorId(){
        return $this->anchorId;
    }

    public function setAnchorId($anchorId){
        $this->anchorId = $anchorId;
        $this->queryParameters["AnchorId"] = $anchorId;
    }

    public function getPageNum(){
        return $this->pageNum;
    }

    public function setPageNum($pageNum){
        $this->pageNum = $pageNum;
        $this->queryParameters["PageNum"] = $pageNum;
    }

    public function getRoomStatus(){
        return $this->roomStatus;
    }

    public function setRoomStatus($roomStatus){
        $this->roomStatus = $roomStatus;
        $this->queryParameters["RoomStatus"] = $roomStatus;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getOrder(){
        return $this->order;
    }

    public function setOrder($order){
        $this->order = $order;
        $this->queryParameters["Order"] = $order;
    }

    public function getEndTime(){
        return $this->endTime;
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
        $this->queryParameters["EndTime"] = $endTime;
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