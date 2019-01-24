<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class ConsumerStatusRequest extends RpcAcsRequest {
    private $preventCache;
    private $onsRegionId;
    private $onsPlatform;
    private $needJstack;
    private $consumerId;
    private $detail;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsConsumerStatus");
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

    public function getNeedJstack(){
        return $this->needJstack;
    }

    public function setNeedJstack($needJstack){
        $this->needJstack = $needJstack;
        $this->queryParameters["NeedJstack"] = $needJstack;
    }

    public function getConsumerId(){
        return $this->consumerId;
    }

    public function setConsumerId($consumerId){
        $this->consumerId = $consumerId;
        $this->queryParameters["ConsumerId"] = $consumerId;
    }

    public function getDetail(){
        return $this->detail;
    }

    public function setDetail($detail){
        $this->detail = $detail;
        $this->queryParameters["Detail"] = $detail;
    }
}