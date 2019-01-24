<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class TopicDeleteRequest extends RpcAcsRequest {
    private $preventCache;
    private $cluster;
    private $onsRegionId;
    private $onsPlatform;
    private $topic;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsTopicDelete");
        $this->setMethod("POST");
    }

    public function getPreventCache(){
        return $this->preventCache;
    }

    public function setPreventCache($preventCache){
        $this->preventCache = $preventCache;
        $this->queryParameters["PreventCache"] = $preventCache;
    }

    public function getCluster(){
        return $this->cluster;
    }

    public function setCluster($cluster){
        $this->cluster = $cluster;
        $this->queryParameters["Cluster"] = $cluster;
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