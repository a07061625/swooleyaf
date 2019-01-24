<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class BindPhoneRequest extends RpcAcsRequest {
    private $phoneNumber;
    private $appKey;
    private $deviceId;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "BindPhone");
        $this->setMethod("POST");
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
        $this->queryParameters["PhoneNumber"] = $phoneNumber;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }

    public function getDeviceId(){
        return $this->deviceId;
    }

    public function setDeviceId($deviceId){
        $this->deviceId = $deviceId;
        $this->queryParameters["DeviceId"] = $deviceId;
    }
}