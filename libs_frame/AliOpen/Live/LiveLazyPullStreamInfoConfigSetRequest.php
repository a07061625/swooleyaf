<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveLazyPullStreamInfoConfigSetRequest extends RpcAcsRequest {
    private $appName;
    private $pullAuthKey;
    private $pullAuthType;
    private $domainName;
    private $pullDomainName;
    private $ownerId;
    private $pullAppName;
    private $pullProtocol;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "SetLiveLazyPullStreamInfoConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }

    public function getPullAuthKey(){
        return $this->pullAuthKey;
    }

    public function setPullAuthKey($pullAuthKey){
        $this->pullAuthKey = $pullAuthKey;
        $this->queryParameters["PullAuthKey"] = $pullAuthKey;
    }

    public function getPullAuthType(){
        return $this->pullAuthType;
    }

    public function setPullAuthType($pullAuthType){
        $this->pullAuthType = $pullAuthType;
        $this->queryParameters["PullAuthType"] = $pullAuthType;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getPullDomainName(){
        return $this->pullDomainName;
    }

    public function setPullDomainName($pullDomainName){
        $this->pullDomainName = $pullDomainName;
        $this->queryParameters["PullDomainName"] = $pullDomainName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPullAppName(){
        return $this->pullAppName;
    }

    public function setPullAppName($pullAppName){
        $this->pullAppName = $pullAppName;
        $this->queryParameters["PullAppName"] = $pullAppName;
    }

    public function getPullProtocol(){
        return $this->pullProtocol;
    }

    public function setPullProtocol($pullProtocol){
        $this->pullProtocol = $pullProtocol;
        $this->queryParameters["PullProtocol"] = $pullProtocol;
    }
}