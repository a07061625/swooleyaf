<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDomainSnapshotDataDescribeRequest extends RpcAcsRequest {
    private $domainName;
    private $endTime;
    private $startTime;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveDomainSnapshotData", "live", "openAPI");
        $this->setMethod("POST");
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
}