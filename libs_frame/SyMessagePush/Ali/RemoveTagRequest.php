<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class RemoveTagRequest extends RpcAcsRequest {
    private $tagName;
    private $appKey;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "RemoveTag");
        $this->setMethod("POST");
    }

    public function getTagName(){
        return $this->tagName;
    }

    public function setTagName($tagName){
        $this->tagName = $tagName;
        $this->queryParameters["TagName"] = $tagName;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }
}