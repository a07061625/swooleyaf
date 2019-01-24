<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveDomainCertificateSetRequest extends RpcAcsRequest {
    private $securityToken;
    private $sSLPub;
    private $certName;
    private $sSLProtocol;
    private $domainName;
    private $ownerId;
    private $sSLPri;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "SetLiveDomainCertificate", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getSSLPub(){
        return $this->sSLPub;
    }

    public function setSSLPub($sSLPub){
        $this->sSLPub = $sSLPub;
        $this->queryParameters["SSLPub"] = $sSLPub;
    }

    public function getCertName(){
        return $this->certName;
    }

    public function setCertName($certName){
        $this->certName = $certName;
        $this->queryParameters["CertName"] = $certName;
    }

    public function getSSLProtocol(){
        return $this->sSLProtocol;
    }

    public function setSSLProtocol($sSLProtocol){
        $this->sSLProtocol = $sSLProtocol;
        $this->queryParameters["SSLProtocol"] = $sSLProtocol;
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

    public function getSSLPri(){
        return $this->sSLPri;
    }

    public function setSSLPri($sSLPri){
        $this->sSLPri = $sSLPri;
        $this->queryParameters["SSLPri"] = $sSLPri;
    }
}