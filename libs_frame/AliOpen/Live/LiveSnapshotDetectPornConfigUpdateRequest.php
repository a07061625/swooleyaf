<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveSnapshotDetectPornConfigUpdateRequest extends RpcAcsRequest {
    private $ossBucket;
    private $appName;
    private $securityToken;
    private $domainName;
    private $ossEndpoint;
    private $interval;
    private $ownerId;
    private $ossObject;
    private $Scenes;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "UpdateLiveSnapshotDetectPornConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getOssBucket(){
        return $this->ossBucket;
    }

    public function setOssBucket($ossBucket){
        $this->ossBucket = $ossBucket;
        $this->queryParameters["OssBucket"] = $ossBucket;
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

    public function getInterval(){
        return $this->interval;
    }

    public function setInterval($interval){
        $this->interval = $interval;
        $this->queryParameters["Interval"] = $interval;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getOssObject(){
        return $this->ossObject;
    }

    public function setOssObject($ossObject){
        $this->ossObject = $ossObject;
        $this->queryParameters["OssObject"] = $ossObject;
    }

    public function getScenes(){
        return $this->Scenes;
    }

    public function setScenes($Scenes){
        $this->Scenes = $Scenes;
        for ($i = 0; $i < count($Scenes); $i ++) {
            $this->queryParameters["Scene." . ($i + 1)] = $Scenes[$i];
        }
    }
}