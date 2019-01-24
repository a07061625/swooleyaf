<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveCertificateDetailDescribeRequest extends RpcAcsRequest {
    private $securityToken;
    private $certName;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeLiveCertificateDetail", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getCertName(){
        return $this->certName;
    }

    public function setCertName($certName){
        $this->certName = $certName;
        $this->queryParameters["CertName"] = $certName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}