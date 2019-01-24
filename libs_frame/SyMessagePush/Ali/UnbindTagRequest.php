<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class UnbindTagRequest extends RpcAcsRequest {
    private $tagName;
    private $clientKey;
    private $appKey;
    private $keyType;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "UnbindTag");
        $this->setMethod("POST");
    }

    public function getTagName(){
        return $this->tagName;
    }

    public function setTagName($tagName){
        $this->tagName = $tagName;
        $this->queryParameters["TagName"] = $tagName;
    }

    public function getClientKey(){
        return $this->clientKey;
    }

    public function setClientKey($clientKey){
        $this->clientKey = $clientKey;
        $this->queryParameters["ClientKey"] = $clientKey;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }

    public function getKeyType(){
        return $this->keyType;
    }

    public function setKeyType($keyType){
        $this->keyType = $keyType;
        $this->queryParameters["KeyType"] = $keyType;
    }
}