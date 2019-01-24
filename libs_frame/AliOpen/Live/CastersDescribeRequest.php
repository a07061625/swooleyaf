<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CastersDescribeRequest extends RpcAcsRequest {
    private $casterName;
    private $casterId;
    private $pageSize;
    private $endTime;
    private $startTime;
    private $ownerId;
    private $pageNum;
    private $status;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeCasters", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getCasterName(){
        return $this->casterName;
    }

    public function setCasterName($casterName){
        $this->casterName = $casterName;
        $this->queryParameters["CasterName"] = $casterName;
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
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

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
        $this->queryParameters["Status"] = $status;
    }
}