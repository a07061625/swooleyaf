<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class MessagePageQueryByTopicRequest extends RpcAcsRequest {
    private $preventCache;
    private $onsRegionId;
    private $onsPlatform;
    private $pageSize;
    private $topic;
    private $endTime;
    private $beginTime;
    private $currentPage;
    private $taskId;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsMessagePageQueryByTopic");
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

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
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

    public function getCurrentPage(){
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage){
        $this->currentPage = $currentPage;
        $this->queryParameters["CurrentPage"] = $currentPage;
    }

    public function getTaskId(){
        return $this->taskId;
    }

    public function setTaskId($taskId){
        $this->taskId = $taskId;
        $this->queryParameters["TaskId"] = $taskId;
    }
}