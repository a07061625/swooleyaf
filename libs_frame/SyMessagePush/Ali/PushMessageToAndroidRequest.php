<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class PushMessageToAndroidRequest extends RpcAcsRequest {
    private $appKey;
    private $targetValue;
    private $title;
    private $body;
    private $jobKey;
    private $target;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "PushMessageToAndroid");
        $this->setMethod("POST");
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }

    public function getTargetValue(){
        return $this->targetValue;
    }

    public function setTargetValue($targetValue){
        $this->targetValue = $targetValue;
        $this->queryParameters["TargetValue"] = $targetValue;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        $this->queryParameters["Title"] = $title;
    }

    public function getBody(){
        return $this->body;
    }

    public function setBody($body){
        $this->body = $body;
        $this->queryParameters["Body"] = $body;
    }

    public function getJobKey(){
        return $this->jobKey;
    }

    public function setJobKey($jobKey){
        $this->jobKey = $jobKey;
        $this->queryParameters["JobKey"] = $jobKey;
    }

    public function getTarget(){
        return $this->target;
    }

    public function setTarget($target){
        $this->target = $target;
        $this->queryParameters["Target"] = $target;
    }
}