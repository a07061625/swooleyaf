<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class MixStreamsServiceStopRequest extends RpcAcsRequest {
    private $securityToken;
    private $mainDomainName;
    private $mixStreamName;
    private $mixDomainName;
    private $ownerId;
    private $mainAppName;
    private $mixAppName;
    private $mainStreamName;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "StopMixStreamsService", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getMainDomainName(){
        return $this->mainDomainName;
    }

    public function setMainDomainName($mainDomainName){
        $this->mainDomainName = $mainDomainName;
        $this->queryParameters["MainDomainName"] = $mainDomainName;
    }

    public function getMixStreamName(){
        return $this->mixStreamName;
    }

    public function setMixStreamName($mixStreamName){
        $this->mixStreamName = $mixStreamName;
        $this->queryParameters["MixStreamName"] = $mixStreamName;
    }

    public function getMixDomainName(){
        return $this->mixDomainName;
    }

    public function setMixDomainName($mixDomainName){
        $this->mixDomainName = $mixDomainName;
        $this->queryParameters["MixDomainName"] = $mixDomainName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getMainAppName(){
        return $this->mainAppName;
    }

    public function setMainAppName($mainAppName){
        $this->mainAppName = $mainAppName;
        $this->queryParameters["MainAppName"] = $mainAppName;
    }

    public function getMixAppName(){
        return $this->mixAppName;
    }

    public function setMixAppName($mixAppName){
        $this->mixAppName = $mixAppName;
        $this->queryParameters["MixAppName"] = $mixAppName;
    }

    public function getMainStreamName(){
        return $this->mainStreamName;
    }

    public function setMainStreamName($mainStreamName){
        $this->mainStreamName = $mainStreamName;
        $this->queryParameters["MainStreamName"] = $mainStreamName;
    }
}