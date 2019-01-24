<?php
namespace AliOpen\Dm;

use AliOpen\Core\RpcAcsRequest;

class MailBatchSendRequest extends RpcAcsRequest {
    private $ownerId;
    private $resourceOwnerAccount;
    private $resourceOwnerId;
    private $templateName;
    private $accountName;
    private $receiversName;
    private $addressType;
    private $tagName;
    private $clickTrace;

    public function __construct(){
        parent::__construct("Dm", "2015-11-23", "BatchSendMail");
    }

    public function getClickTrace(){
        return $this->clickTrace;
    }

    public function setClickTrace($clickTrace){
        $this->clickTrace = $clickTrace;
        $this->queryParameters["ClickTrace"] = $clickTrace;
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

    public function getTemplateName(){
        return $this->templateName;
    }

    public function setTemplateName($templateName){
        $this->templateName = $templateName;
        $this->queryParameters["TemplateName"] = $templateName;
    }

    public function getAccountName(){
        return $this->accountName;
    }

    public function setAccountName($accountName){
        $this->accountName = $accountName;
        $this->queryParameters["AccountName"] = $accountName;
    }

    public function getReceiversName(){
        return $this->receiversName;
    }

    public function setReceiversName($receiversName){
        $this->receiversName = $receiversName;
        $this->queryParameters["ReceiversName"] = $receiversName;
    }

    public function getAddressType(){
        return $this->addressType;
    }

    public function setAddressType($addressType){
        $this->addressType = $addressType;
        $this->queryParameters["AddressType"] = $addressType;
    }

    public function getTagName(){
        return $this->tagName;
    }

    public function setTagName($tagName){
        $this->tagName = $tagName;
        $this->queryParameters["TagName"] = $tagName;
    }
}