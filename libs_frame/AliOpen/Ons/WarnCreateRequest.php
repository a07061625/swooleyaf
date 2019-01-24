<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class WarnCreateRequest extends RpcAcsRequest {
    private $preventCache;
    private $onsRegionId;
    private $onsPlatform;
    private $blockTime;
    private $level;
    private $consumerId;
    private $delayTime;
    private $topic;
    private $threshold;
    private $alertTime;
    private $contacts;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsWarnCreate");
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

    public function getBlockTime(){
        return $this->blockTime;
    }

    public function setBlockTime($blockTime){
        $this->blockTime = $blockTime;
        $this->queryParameters["BlockTime"] = $blockTime;
    }

    public function getLevel(){
        return $this->level;
    }

    public function setLevel($level){
        $this->level = $level;
        $this->queryParameters["Level"] = $level;
    }

    public function getConsumerId(){
        return $this->consumerId;
    }

    public function setConsumerId($consumerId){
        $this->consumerId = $consumerId;
        $this->queryParameters["ConsumerId"] = $consumerId;
    }

    public function getDelayTime(){
        return $this->delayTime;
    }

    public function setDelayTime($delayTime){
        $this->delayTime = $delayTime;
        $this->queryParameters["DelayTime"] = $delayTime;
    }

    public function getTopic(){
        return $this->topic;
    }

    public function setTopic($topic){
        $this->topic = $topic;
        $this->queryParameters["Topic"] = $topic;
    }

    public function getThreshold(){
        return $this->threshold;
    }

    public function setThreshold($threshold){
        $this->threshold = $threshold;
        $this->queryParameters["Threshold"] = $threshold;
    }

    public function getAlertTime(){
        return $this->alertTime;
    }

    public function setAlertTime($alertTime){
        $this->alertTime = $alertTime;
        $this->queryParameters["AlertTime"] = $alertTime;
    }

    public function getContacts(){
        return $this->contacts;
    }

    public function setContacts($contacts){
        $this->contacts = $contacts;
        $this->queryParameters["Contacts"] = $contacts;
    }
}