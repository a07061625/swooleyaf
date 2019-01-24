<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class MqttManualUpdateRuleRequest extends RpcAcsRequest {
    private $preventCache;
    private $onsRegionId;
    private $instanceId;
    private $onsPlatform;
    private $ownerId;
    private $adminKey;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsMqttManualUpdateRule");
        $this->setMethod("POST");
    }

    public function getPreventCache(){
        return $this->preventCache;
    }

    public function setPreventCache($preventCache){
        $this->preventCache = $preventCache;
        $this->queryParameters["PreventCache"] = $preventCache;
    }

    public function getOnsRegionId(){
        return $this->onsRegionId;
    }

    public function setOnsRegionId($onsRegionId){
        $this->onsRegionId = $onsRegionId;
        $this->queryParameters["OnsRegionId"] = $onsRegionId;
    }

    public function getInstanceId(){
        return $this->instanceId;
    }

    public function setInstanceId($instanceId){
        $this->instanceId = $instanceId;
        $this->queryParameters["InstanceId"] = $instanceId;
    }

    public function getOnsPlatform(){
        return $this->onsPlatform;
    }

    public function setOnsPlatform($onsPlatform){
        $this->onsPlatform = $onsPlatform;
        $this->queryParameters["OnsPlatform"] = $onsPlatform;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getAdminKey(){
        return $this->adminKey;
    }

    public function setAdminKey($adminKey){
        $this->adminKey = $adminKey;
        $this->queryParameters["AdminKey"] = $adminKey;
    }
}