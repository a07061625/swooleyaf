<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class MqttQueryMsgTransTrendRequest extends RpcAcsRequest {
    private $preventCache;
    private $onsRegionId;
    private $onsPlatform;
    private $qos;
    private $transType;
    private $endTime;
    private $beginTime;
    private $tpsType;
    private $parentTopic;
    private $msgType;
    private $subTopic;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsMqttQueryMsgTransTrend");
        $this->setMethod("POST");
    }

    public function getPreventCache(){
        return $this->preventCache;
    }

    public function setPreventCache($preventCache){
        $this->preventCache = $preventCache;
        $this->queryParameters["PreventCache"] = $preventCache;
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

    public function getQos(){
        return $this->qos;
    }

    public function setQos($qos){
        $this->qos = $qos;
        $this->queryParameters["Qos"] = $qos;
    }

    public function getTransType(){
        return $this->transType;
    }

    public function setTransType($transType){
        $this->transType = $transType;
        $this->queryParameters["TransType"] = $transType;
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

    public function getTpsType(){
        return $this->tpsType;
    }

    public function setTpsType($tpsType){
        $this->tpsType = $tpsType;
        $this->queryParameters["TpsType"] = $tpsType;
    }

    public function getParentTopic(){
        return $this->parentTopic;
    }

    public function setParentTopic($parentTopic){
        $this->parentTopic = $parentTopic;
        $this->queryParameters["ParentTopic"] = $parentTopic;
    }

    public function getMsgType(){
        return $this->msgType;
    }

    public function setMsgType($msgType){
        $this->msgType = $msgType;
        $this->queryParameters["MsgType"] = $msgType;
    }

    public function getSubTopic(){
        return $this->subTopic;
    }

    public function setSubTopic($subTopic){
        $this->subTopic = $subTopic;
        $this->queryParameters["SubTopic"] = $subTopic;
    }
}