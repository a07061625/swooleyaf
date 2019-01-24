<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class MqttQueryTraceByTraceIdRequest extends RpcAcsRequest {
    private $traceId;
    private $preventCache;
    private $onsRegionId;
    private $onsPlatform;
    private $topic;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsMqttQueryTraceByTraceId");
        $this->setMethod("POST");
    }

    public function getTraceId(){
        return $this->traceId;
    }

    public function setTraceId($traceId){
        $this->traceId = $traceId;
        $this->queryParameters["TraceId"] = $traceId;
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
}