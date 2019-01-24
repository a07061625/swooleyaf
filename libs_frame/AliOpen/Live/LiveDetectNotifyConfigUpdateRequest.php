<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDetectNotifyConfigUpdateRequest extends RpcAcsRequest {
    private $securityToken;
    private $domainName;
    private $notifyUrl;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "UpdateLiveDetectNotifyConfig", "live", "openAPI");
        $this->setMethod("POST");
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

    public function getNotifyUrl(){
        return $this->notifyUrl;
    }

    public function setNotifyUrl($notifyUrl){
        $this->notifyUrl = $notifyUrl;
        $this->queryParameters["NotifyUrl"] = $notifyUrl;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}