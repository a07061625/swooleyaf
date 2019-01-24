<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class MessagePushRequest extends RpcAcsRequest {
    private $preventCache;
    private $onsRegionId;
    private $clientId;
    private $onsPlatform;
    private $consumerId;
    private $msgId;
    private $topic;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsMessagePush");
        $this->setMethod("POST");
    }

    public function getPreventCache(){
        return $this->preventCache;
    }

    public function setPreventCache($preventCache){
        $this->preventCache = $preventCache;
        $this->queryParameters["PreventCache"] = $preventCache;
    }

    public function getOnsRegionId(){
        return $this->onsRegionId;
    }

    public function setOnsRegionId($onsRegionId){
        $this->onsRegionId = $onsRegionId;
        $this->queryParameters["OnsRegionId"] = $onsRegionId;
    }

    public function getClientId(){
        return $this->clientId;
    }

    public function setClientId($clientId){
        $this->clientId = $clientId;
        $this->queryParameters["ClientId"] = $clientId;
    }

    public function getOnsPlatform(){
        return $this->onsPlatform;
    }

    public function setOnsPlatform($onsPlatform){
        $this->onsPlatform = $onsPlatform;
        $this->queryParameters["OnsPlatform"] = $onsPlatform;
    }

    public function getConsumerId(){
        return $this->consumerId;
    }

    public function setConsumerId($consumerId){
        $this->consumerId = $consumerId;
        $this->queryParameters["ConsumerId"] = $consumerId;
    }

    public function getMsgId(){
        return $this->msgId;
    }

    public function setMsgId($msgId){
        $this->msgId = $msgId;
        $this->queryParameters["MsgId"] = $msgId;
    }

    public function getTopic(){
        return $this->topic;
    }

    public function setTopic($topic){
        $this->topic = $topic;
        $this->queryParameters["Topic"] = $topic;
    }
}