<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class QueryDeviceStatRequest extends RpcAcsRequest {
    private $endTime;
    private $appKey;
    private $startTime;
    private $deviceType;
    private $queryType;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "QueryDeviceStat");
        $this->setMethod("POST");
    }

    public function getEndTime(){
        return $this->endTime;
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
        $this->queryParameters["EndTime"] = $endTime;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getDeviceType(){
        return $this->deviceType;
    }

    public function setDeviceType($deviceType){
        $this->deviceType = $deviceType;
        $this->queryParameters["DeviceType"] = $deviceType;
    }

    public function getQueryType(){
        return $this->queryType;
    }

    public function setQueryType($queryType){
        $this->queryType = $queryType;
        $this->queryParameters["QueryType"] = $queryType;
    }
}