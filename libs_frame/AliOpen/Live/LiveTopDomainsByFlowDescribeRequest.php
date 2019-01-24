<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveTopDomainsByFlowDescribeRequest extends RpcAcsRequest {
    private $startTime;
    private $limit;
    private $endTime;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveTopDomainsByFlow", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getLimit(){
        return $this->limit;
    }

    public function setLimit($limit){
        $this->limit = $limit;
        $this->queryParameters["Limit"] = $limit;
    }

    public function getEndTime(){
        return $this->endTime;
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
        $this->queryParameters["EndTime"] = $endTime;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}