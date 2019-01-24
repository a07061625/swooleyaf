<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveRecordVodConfigAddRequest extends RpcAcsRequest {
    private $appName;
    private $autoCompose;
    private $domainName;
    private $cycleDuration;
    private $ownerId;
    private $composeVodTranscodeGroupId;
    private $streamName;
    private $vodTranscodeGroupId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddLiveRecordVodConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }

    public function getAutoCompose(){
        return $this->autoCompose;
    }

    public function setAutoCompose($autoCompose){
        $this->autoCompose = $autoCompose;
        $this->queryParameters["AutoCompose"] = $autoCompose;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getCycleDuration(){
        return $this->cycleDuration;
    }

    public function setCycleDuration($cycleDuration){
        $this->cycleDuration = $cycleDuration;
        $this->queryParameters["CycleDuration"] = $cycleDuration;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getComposeVodTranscodeGroupId(){
        return $this->composeVodTranscodeGroupId;
    }

    public function setComposeVodTranscodeGroupId($composeVodTranscodeGroupId){
        $this->composeVodTranscodeGroupId = $composeVodTranscodeGroupId;
        $this->queryParameters["ComposeVodTranscodeGroupId"] = $composeVodTranscodeGroupId;
    }

    public function getStreamName(){
        return $this->streamName;
    }

    public function setStreamName($streamName){
        $this->streamName = $streamName;
        $this->queryParameters["StreamName"] = $streamName;
    }

    public function getVodTranscodeGroupId(){
        return $this->vodTranscodeGroupId;
    }

    public function setVodTranscodeGroupId($vodTranscodeGroupId){
        $this->vodTranscodeGroupId = $vodTranscodeGroupId;
        $this->queryParameters["VodTranscodeGroupId"] = $vodTranscodeGroupId;
    }
}