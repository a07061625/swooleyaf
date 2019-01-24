<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveStreamTranscodeInfoDescribeRequest extends RpcAcsRequest {
    private $securityToken;
    private $ownerId;
    private $domainTranscodeName;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveStreamTranscodeInfo", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getDomainTranscodeName(){
        return $this->domainTranscodeName;
    }

    public function setDomainTranscodeName($domainTranscodeName){
        $this->domainTranscodeName = $domainTranscodeName;
        $this->queryParameters["DomainTranscodeName"] = $domainTranscodeName;
    }
}