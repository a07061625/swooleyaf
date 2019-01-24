<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class CheckDevicesRequest extends RpcAcsRequest {
    private $deviceIds;
    private $appKey;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "CheckDevices");
        $this->setMethod("POST");
    }

    public function getDeviceIds(){
        return $this->deviceIds;
    }

    public function setDeviceIds($deviceIds){
        $this->deviceIds = $deviceIds;
        $this->queryParameters["DeviceIds"] = $deviceIds;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }
}