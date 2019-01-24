<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class TraceQueryByMsgKeyRequest extends RpcAcsRequest {
    private $preventCache;
    private $onsRegionId;
    private $onsPlatform;
    private $topic;
    private $endTime;
    private $beginTime;
    private $msgKey;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsTraceQueryByMsgKey");
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

    public function getMsgKey(){
        return $this->msgKey;
    }

    public function setMsgKey($msgKey){
        $this->msgKey = $msgKey;
        $this->queryParameters["MsgKey"] = $msgKey;
    }
}