<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveRecordNotifyConfigAddRequest extends RpcAcsRequest {
    private $onDemandUrl;
    private $securityToken;
    private $domainName;
    private $notifyUrl;
    private $ownerId;
    private $needStatusNotify;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddLiveRecordNotifyConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getOnDemandUrl(){
        return $this->onDemandUrl;
    }

    public function setOnDemandUrl($onDemandUrl){
        $this->onDemandUrl = $onDemandUrl;
        $this->queryParameters["OnDemandUrl"] = $onDemandUrl;
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

    public function getNeedStatusNotify(){
        return $this->needStatusNotify;
    }

    public function setNeedStatusNotify($needStatusNotify){
        $this->needStatusNotify = $needStatusNotify;
        $this->queryParameters["NeedStatusNotify"] = $needStatusNotify;
    }
}