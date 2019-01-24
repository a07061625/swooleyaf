<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class UnbindAliasRequest extends RpcAcsRequest {
    private $aliasName;
    private $appKey;
    private $deviceId;
    private $unbindAll;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "UnbindAlias");
        $this->setMethod("POST");
    }

    public function getAliasName(){
        return $this->aliasName;
    }

    public function setAliasName($aliasName){
        $this->aliasName = $aliasName;
        $this->queryParameters["AliasName"] = $aliasName;
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

    public function getUnbindAll(){
        return $this->unbindAll;
    }

    public function setUnbindAll($unbindAll){
        $this->unbindAll = $unbindAll;
        $this->queryParameters["UnbindAll"] = $unbindAll;
    }
}