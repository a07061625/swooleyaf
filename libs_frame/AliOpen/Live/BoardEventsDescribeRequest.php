<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class BoardEventsDescribeRequest extends RpcAcsRequest {
    private $startTime;
    private $boardId;
    private $endTime;
    private $ownerId;
    private $appId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeBoardEvents", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getBoardId(){
        return $this->boardId;
    }

    public function setBoardId($boardId){
        $this->boardId = $boardId;
        $this->queryParameters["BoardId"] = $boardId;
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

    public function getAppId(){
        return $this->appId;
    }

    public function setAppId($appId){
        $this->appId = $appId;
        $this->queryParameters["AppId"] = $appId;
    }
}