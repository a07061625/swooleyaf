<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class AuditSecurityIpListRequest extends RpcAcsRequest {
    private $securityGroupName;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "ListAuditSecurityIp", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getSecurityGroupName(){
        return $this->securityGroupName;
    }

    public function setSecurityGroupName($securityGroupName){
        $this->securityGroupName = $securityGroupName;
        $this->queryParameters["SecurityGroupName"] = $securityGroupName;
    }
}