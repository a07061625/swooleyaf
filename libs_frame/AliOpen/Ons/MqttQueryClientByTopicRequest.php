<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class MqttQueryClientByTopicRequest extends RpcAcsRequest {
    private $preventCache;
    private $onsRegionId;
    private $onsPlatform;
    private $parentTopic;
    private $subTopic;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsMqttQueryClientByTopic");
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

    public function getParentTopic(){
        return $this->parentTopic;
    }

    public function setParentTopic($parentTopic){
        $this->parentTopic = $parentTopic;
        $this->queryParameters["ParentTopic"] = $parentTopic;
    }

    public function getSubTopic(){
        return $this->subTopic;
    }

    public function setSubTopic($subTopic){
        $this->subTopic = $subTopic;
        $this->queryParameters["SubTopic"] = $subTopic;
    }
}