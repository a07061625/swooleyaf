<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class LiveStreamTranscodeDeleteRequest extends RpcAcsRequest {
    private $app;
    private $template;
    private $securityToken;
    private $domain;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DeleteLiveStreamTranscode", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getApp(){
        return $this->app;
    }

    public function setApp($app){
        $this->app = $app;
        $this->queryParameters["App"] = $app;
    }

    public function getTemplate(){
        return $this->template;
    }

    public function setTemplate($template){
        $this->template = $template;
        $this->queryParameters["Template"] = $template;
    }

    public function getSecurityToken(){
        return $this->securityToken;
    }

    public function setSecurityToken($securityToken){
        $this->securityToken = $securityToken;
        $this->queryParameters["SecurityToken"] = $securityToken;
    }

    public function getDomain(){
        return $this->domain;
    }

    public function setDomain($domain){
        $this->domain = $domain;
        $this->queryParameters["Domain"] = $domain;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}