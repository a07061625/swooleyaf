<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class QueryUniqueDeviceStatRequest extends RpcAcsRequest {
    private $granularity;
    private $endTime;
    private $appKey;
    private $startTime;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "QueryUniqueDeviceStat");
        $this->setMethod("POST");
    }

    public function getGranularity(){
        return $this->granularity;
    }

    public function setGranularity($granularity){
        $this->granularity = $granularity;
        $this->queryParameters["Granularity"] = $granularity;
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
}