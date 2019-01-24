<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class TopicSearchRequest extends RpcAcsRequest {
    private $preventCache;
    private $search;
    private $onsRegionId;
    private $onsPlatform;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsTopicSearch");
        $this->setMethod("POST");
    }

    public function getPreventCache(){
        return $this->preventCache;
    }

    public function setPreventCache($preventCache){
        $this->preventCache = $preventCache;
        $this->queryParameters["PreventCache"] = $preventCache;
    }

    public function getSearch(){
        return $this->search;
    }

    public function setSearch($search){
        $this->search = $search;
        $this->queryParameters["Search"] = $search;
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
}