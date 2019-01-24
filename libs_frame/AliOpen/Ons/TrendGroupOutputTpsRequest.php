<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class TrendGroupOutputTpsRequest extends RpcAcsRequest {
    private $preventCache;
    private $period;
    private $onsRegionId;
    private $onsPlatform;
    private $consumerId;
    private $topic;
    private $endTime;
    private $beginTime;
    private $type;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsTrendGroupOutputTps");
        $this->setMethod("POST");
    }

    public function getPreventCache(){
        return $this->preventCache;
    }

    public function setPreventCache($preventCache){
        $this->preventCache = $preventCache;
        $this->queryParameters["PreventCache"] = $preventCache;
    }

    public function getPeriod(){
        return $this->period;
    }

    public function setPeriod($period){
        $this->period = $period;
        $this->queryParameters["Period"] = $period;
    }

    public function getOnsRegionId(){
        return $this->onsRegionId;
    }

    public function setOnsRegionId($onsRegionId){
        $this->onsRegionId = $onsRegionId;
        $this->queryParameters["OnsRegionId"] = $onsRegionId;
    }

    public function getOnsPlatform(){
        return $this->onsPlatform;
    }

    public function setOnsPlatform($onsPlatform){
        $this->onsPlatform = $onsPlatform;
        $this->queryParameters["OnsPlatform"] = $onsPlatform;
    }

    public function getConsumerId(){
        return $this->consumerId;
    }

    public function setConsumerId($consumerId){
        $this->consumerId = $consumerId;
        $this->queryParameters["ConsumerId"] = $consumerId;
    }

    public function getTopic(){
        return $this->topic;
    }

    public function setTopic($topic){
        $this->topic = $topic;
        $this->queryParameters["Topic"] = $topic;
    }

    public function getEndTime(){
        return $this->endTime;
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
        $this->queryParameters["EndTime"] = $endTime;
    }

    public function getBeginTime(){
        return $this->beginTime;
    }

    public function setBeginTime($beginTime){
        $this->beginTime = $beginTime;
        $this->queryParameters["BeginTime"] = $beginTime;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
        $this->queryParameters["Type"] = $type;
    }
}