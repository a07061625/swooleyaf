<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class PlayUserAvgDescribeRequest extends RpcAcsRequest {
    private $endTime;
    private $startTime;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "DescribePlayUserAvg", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getEndTime(){
        return $this->endTime;
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
        $this->queryParameters["EndTime"] = $endTime;
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}