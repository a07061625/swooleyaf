<?php
namespace AliOpen\Dm;

use AliOpen\Core\RpcAcsRequest;

class MailSingleSendRequest extends RpcAcsRequest {
    private $ownerId;
    private $resourceOwnerAccount;
    private $resourceOwnerId;
    private $accountName;
    private $addressType;
    private $tagName;
    private $replyToAddress;
    private $toAddress;
    private $subject;
    private $htmlBody;
    private $textBody;
    private $fromAlias;
    private $clickTrace;

    public function __construct(){
        parent::__construct("Dm", "2015-11-23", "SingleSendMail");
        parent::setMethod("POST");
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

    public function getAccountName(){
        return $this->accountName;
    }

    public function setAccountName($accountName){
        $this->accountName = $accountName;
        $this->queryParameters["AccountName"] = $accountName;
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

    public function getReplyToAddress(){
        return $this->replyToAddress;
    }

    public function setReplyToAddress($replyToAddress){
        $this->replyToAddress = $replyToAddress;
        $this->queryParameters["ReplyToAddress"] = $replyToAddress;
    }

    public function getToAddress(){
        return $this->toAddress;
    }

    public function setToAddress($toAddress){
        $this->toAddress = $toAddress;
        $this->queryParameters["ToAddress"] = $toAddress;
    }

    public function getSubject(){
        return $this->subject;
    }

    public function setSubject($subject){
        $this->subject = $subject;
        $this->queryParameters["Subject"] = $subject;
    }

    public function getHtmlBody(){
        return $this->htmlBody;
    }

    public function setHtmlBody($htmlBody){
        $this->htmlBody = $htmlBody;
        $this->queryParameters["HtmlBody"] = $htmlBody;
    }

    public function getTextBody(){
        return $this->textBody;
    }

    public function setTextBody($textBody){
        $this->textBody = $textBody;
        $this->queryParameters["TextBody"] = $textBody;
    }

    public function getFromAlias(){
        return $this->fromAlias;
    }

    public function setFromAlias($fromAlias){
        $this->fromAlias = $fromAlias;
        $this->queryParameters["FromAlias"] = $fromAlias;
    }
}