<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class AuditSecurityIpSetRequest extends RpcAcsRequest {
    private $operateMode;
    private $securityGroupName;
    private $ips;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "SetAuditSecurityIp", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getOperateMode(){
        return $this->operateMode;
    }

    public function setOperateMode($operateMode){
        $this->operateMode = $operateMode;
        $this->queryParameters["OperateMode"] = $operateMode;
    }

    public function getSecurityGroupName(){
        return $this->securityGroupName;
    }

    public function setSecurityGroupName($securityGroupName){
        $this->securityGroupName = $securityGroupName;
        $this->queryParameters["SecurityGroupName"] = $securityGroupName;
    }

    public function getIps(){
        return $this->ips;
    }

    public function setIps($ips){
        $this->ips = $ips;
        $this->queryParameters["Ips"] = $ips;
    }
}