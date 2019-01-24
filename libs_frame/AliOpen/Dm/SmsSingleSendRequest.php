<?php
namespace AliOpen\Dm;

use AliOpen\Core\RpcAcsRequest;

class SmsSingleSendRequest extends RpcAcsRequest {
    private $ownerId;
    private $resourceOwnerAccount;
    private $resourceOwnerId;
    private $signName;
    private $templateCode;
    private $recNum;
    private $paramString;

    public function __construct(){
        parent::__construct("Dm", "2015-11-23", "SingleSendSms");
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getSignName(){
        return $this->signName;
    }

    public function setSignName($signName){
        $this->signName = $signName;
        $this->queryParameters["SignName"] = $signName;
    }

    public function getTemplateCode(){
        return $this->templateCode;
    }

    public function setTemplateCode($templateCode){
        $this->templateCode = $templateCode;
        $this->queryParameters["TemplateCode"] = $templateCode;
    }

    public function getRecNum(){
        return $this->recNum;
    }

    public function setRecNum($recNum){
        $this->recNum = $recNum;
        $this->queryParameters["RecNum"] = $recNum;
    }

    public function getParamString(){
        return $this->paramString;
    }

    public function setParamString($paramString){
        $this->paramString = $paramString;
        $this->queryParameters["ParamString"] = $paramString;
    }
}