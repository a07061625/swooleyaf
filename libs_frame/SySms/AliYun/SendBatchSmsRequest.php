<?php
namespace SySms\AliYun;

use AliOpen\Core\RpcAcsRequest;

class SendBatchSmsRequest extends RpcAcsRequest {
    private $templateCode;
    private $templateParamJson;
    private $resourceOwnerAccount;
    private $smsUpExtendCodeJson;
    private $resourceOwnerId;
    private $signNameJson;
    private $ownerId;
    private $phoneNumberJson;

    public function __construct(){
        parent::__construct("Dysmsapi", "2017-05-25", "SendBatchSms");
        $this->setMethod("POST");
    }

    public function getTemplateCode(){
        return $this->templateCode;
    }

    public function setTemplateCode($templateCode){
        $this->templateCode = $templateCode;
        $this->queryParameters["TemplateCode"] = $templateCode;
    }

    public function getTemplateParamJson(){
        return $this->templateParamJson;
    }

    public function setTemplateParamJson($templateParamJson){
        $this->templateParamJson = $templateParamJson;
        $this->queryParameters["TemplateParamJson"] = $templateParamJson;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getSmsUpExtendCodeJson(){
        return $this->smsUpExtendCodeJson;
    }

    public function setSmsUpExtendCodeJson($smsUpExtendCodeJson){
        $this->smsUpExtendCodeJson = $smsUpExtendCodeJson;
        $this->queryParameters["SmsUpExtendCodeJson"] = $smsUpExtendCodeJson;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getSignNameJson(){
        return $this->signNameJson;
    }

    public function setSignNameJson($signNameJson){
        $this->signNameJson = $signNameJson;
        $this->queryParameters["SignNameJson"] = $signNameJson;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPhoneNumberJson(){
        return $this->phoneNumberJson;
    }

    public function setPhoneNumberJson($phoneNumberJson){
        $this->phoneNumberJson = $phoneNumberJson;
        $this->queryParameters["PhoneNumberJson"] = $phoneNumberJson;
    }
}