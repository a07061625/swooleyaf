<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveLazyPullStreamConfigDescribeRequest extends RpcAcsRequest {
    private $domainName;
    private $ownerId;
    private $appName;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveLazyPullStreamConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }
}