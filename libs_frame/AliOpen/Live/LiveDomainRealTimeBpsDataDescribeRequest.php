<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDomainRealTimeBpsDataDescribeRequest extends RpcAcsRequest {
    private $locationNameEn;
    private $ispNameEn;
    private $startTime;
    private $domainName;
    private $endTime;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveDomainRealTimeBpsData", "live", "openAPI");
    }

    public function getLocationNameEn(){
        return $this->locationNameEn;
    }

    public function setLocationNameEn($locationNameEn){
        $this->locationNameEn = $locationNameEn;
        $this->queryParameters["LocationNameEn"] = $locationNameEn;
    }

    public function getIspNameEn(){
        return $this->ispNameEn;
    }

    public function setIspNameEn($ispNameEn){
        $this->ispNameEn = $ispNameEn;
        $this->queryParameters["IspNameEn"] = $ispNameEn;
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
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

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}