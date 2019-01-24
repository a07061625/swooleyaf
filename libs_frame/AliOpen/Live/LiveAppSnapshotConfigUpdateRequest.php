<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveAppSnapshotConfigUpdateRequest extends RpcAcsRequest {
    private $timeInterval;
    private $ossBucket;
    private $appName;
    private $securityToken;
    private $domainName;
    private $ossEndpoint;
    private $sequenceOssObject;
    private $overwriteOssObject;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "UpdateLiveAppSnapshotConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getTimeInterval(){
        return $this->timeInterval;
    }

    public function setTimeInterval($timeInterval){
        $this->timeInterval = $timeInterval;
        $this->queryParameters["TimeInterval"] = $timeInterval;
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

    public function getSequenceOssObject(){
        return $this->sequenceOssObject;
    }

    public function setSequenceOssObject($sequenceOssObject){
        $this->sequenceOssObject = $sequenceOssObject;
        $this->queryParameters["SequenceOssObject"] = $sequenceOssObject;
    }

    public function getOverwriteOssObject(){
        return $this->overwriteOssObject;
    }

    public function setOverwriteOssObject($overwriteOssObject){
        $this->overwriteOssObject = $overwriteOssObject;
        $this->queryParameters["OverwriteOssObject"] = $overwriteOssObject;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}