<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveStreamForbidRequest extends RpcAcsRequest {
    private $resumeTime;
    private $appName;
    private $liveStreamType;
    private $domainName;
    private $ownerId;
    private $oneshot;
    private $streamName;
    private $controlStreamAction;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "ForbidLiveStream", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getResumeTime(){
        return $this->resumeTime;
    }

    public function setResumeTime($resumeTime){
        $this->resumeTime = $resumeTime;
        $this->queryParameters["ResumeTime"] = $resumeTime;
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }

    public function getLiveStreamType(){
        return $this->liveStreamType;
    }

    public function setLiveStreamType($liveStreamType){
        $this->liveStreamType = $liveStreamType;
        $this->queryParameters["LiveStreamType"] = $liveStreamType;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getOneshot(){
        return $this->oneshot;
    }

    public function setOneshot($oneshot){
        $this->oneshot = $oneshot;
        $this->queryParameters["Oneshot"] = $oneshot;
    }

    public function getStreamName(){
        return $this->streamName;
    }

    public function setStreamName($streamName){
        $this->streamName = $streamName;
        $this->queryParameters["StreamName"] = $streamName;
    }

    public function getControlStreamAction(){
        return $this->controlStreamAction;
    }

    public function setControlStreamAction($controlStreamAction){
        $this->controlStreamAction = $controlStreamAction;
        $this->queryParameters["ControlStreamAction"] = $controlStreamAction;
    }
}