<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveStreamsOnlineListDescribeRequest extends RpcAcsRequest {
    private $streamType;
    private $domainName;
    private $endTime;
    private $orderBy;
    private $startTime;
    private $ownerId;
    private $pageNum;
    private $appName;
    private $pageSize;
    private $streamName;
    private $queryType;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveStreamsOnlineList", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getStreamType(){
        return $this->streamType;
    }

    public function setStreamType($streamType){
        $this->streamType = $streamType;
        $this->queryParameters["StreamType"] = $streamType;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getEndTime(){
        return $this->endTime;
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
        $this->queryParameters["EndTime"] = $endTime;
    }

    public function getOrderBy(){
        return $this->orderBy;
    }

    public function setOrderBy($orderBy){
        $this->orderBy = $orderBy;
        $this->queryParameters["OrderBy"] = $orderBy;
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPageNum(){
        return $this->pageNum;
    }

    public function setPageNum($pageNum){
        $this->pageNum = $pageNum;
        $this->queryParameters["PageNum"] = $pageNum;
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getStreamName(){
        return $this->streamName;
    }

    public function setStreamName($streamName){
        $this->streamName = $streamName;
        $this->queryParameters["StreamName"] = $streamName;
    }

    public function getQueryType(){
        return $this->queryType;
    }

    public function setQueryType($queryType){
        $this->queryType = $queryType;
        $this->queryParameters["QueryType"] = $queryType;
    }
}