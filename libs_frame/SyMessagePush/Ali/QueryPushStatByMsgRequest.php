<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class QueryPushStatByMsgRequest extends RpcAcsRequest {
    private $messageId;
    private $appKey;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "QueryPushStatByMsg");
        $this->setMethod("POST");
    }

    public function getMessageId(){
        return $this->messageId;
    }

    public function setMessageId($messageId){
        $this->messageId = $messageId;
        $this->queryParameters["MessageId"] = $messageId;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }
}