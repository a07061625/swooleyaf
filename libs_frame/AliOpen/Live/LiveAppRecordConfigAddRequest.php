<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveAppRecordConfigAddRequest extends RpcAcsRequest {
    private $ossBucket;
    private $domainName;
    private $ossEndpoint;
    private $endTime;
    private $startTime;
    private $ownerId;
    private $appName;
    private $securityToken;
    private $RecordFormats;
    private $onDemand;
    private $streamName;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddLiveAppRecordConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getOssBucket(){
        return $this->ossBucket;
    }

    public function setOssBucket($ossBucket){
        $this->ossBucket = $ossBucket;
        $this->queryParameters["OssBucket"] = $ossBucket;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getOssEndpoint(){
        return $this->ossEndpoint;
    }

    public function setOssEndpoint($ossEndpoint){
        $this->ossEndpoint = $ossEndpoint;
        $this->queryParameters["OssEndpoint"] = $ossEndpoint;
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

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getRecordFormats(){
        return $this->RecordFormats;
    }

    public function setRecordFormats($RecordFormats){
        $this->RecordFormats = $RecordFormats;
        for ($i = 0; $i < count($RecordFormats); $i ++) {
            $this->queryParameters['RecordFormat.' . ($i + 1) . '.SliceOssObjectPrefix'] = $RecordFormats[$i]['SliceOssObjectPrefix'];
            $this->queryParameters['RecordFormat.' . ($i + 1) . '.Format'] = $RecordFormats[$i]['Format'];
            $this->queryParameters['RecordFormat.' . ($i + 1) . '.OssObjectPrefix'] = $RecordFormats[$i]['OssObjectPrefix'];
            $this->queryParameters['RecordFormat.' . ($i + 1) . '.CycleDuration'] = $RecordFormats[$i]['CycleDuration'];
        }
    }

    public function getOnDemand(){
        return $this->onDemand;
    }

    public function setOnDemand($onDemand){
        $this->onDemand = $onDemand;
        $this->queryParameters["OnDemand"] = $onDemand;
    }

    public function getStreamName(){
        return $this->streamName;
    }

    public function setStreamName($streamName){
        $this->streamName = $streamName;
        $this->queryParameters["StreamName"] = $streamName;
    }
}