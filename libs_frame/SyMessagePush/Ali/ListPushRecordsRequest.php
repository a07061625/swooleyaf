<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class ListPushRecordsRequest extends RpcAcsRequest {
    private $pageSize;
    private $endTime;
    private $appKey;
    private $startTime;
    private $page;
    private $pushType;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "ListPushRecords");
        $this->setMethod("POST");
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getEndTime(){
        return $this->endTime;
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
        $this->queryParameters["EndTime"] = $endTime;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getPage(){
        return $this->page;
    }

    public function setPage($page){
        $this->page = $page;
        $this->queryParameters["Page"] = $page;
    }

    public function getPushType(){
        return $this->pushType;
    }

    public function setPushType($pushType){
        $this->pushType = $pushType;
        $this->queryParameters["PushType"] = $pushType;
    }
}