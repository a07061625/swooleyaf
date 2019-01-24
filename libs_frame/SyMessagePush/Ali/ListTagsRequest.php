<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class ListTagsRequest extends RpcAcsRequest {
    private $appKey;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "ListTags");
        $this->setMethod("POST");
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }
}