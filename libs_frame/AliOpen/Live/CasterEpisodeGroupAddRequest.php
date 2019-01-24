<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterEpisodeGroupAddRequest extends RpcAcsRequest {
    private $sideOutputUrl;
    private $Items;
    private $clientToken;
    private $domainName;
    private $startTime;
    private $repeatNum;
    private $callbackUrl;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddCasterEpisodeGroup", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSideOutputUrl(){
        return $this->sideOutputUrl;
    }

    public function setSideOutputUrl($sideOutputUrl){
        $this->sideOutputUrl = $sideOutputUrl;
        $this->queryParameters["SideOutputUrl"] = $sideOutputUrl;
    }

    public function getItems(){
        return $this->Items;
    }

    public function setItems($Items){
        $this->Items = $Items;
        for ($i = 0; $i < count($Items); $i ++) {
            $this->queryParameters['Item.' . ($i + 1) . '.VodUrl'] = $Items[$i]['VodUrl'];
            $this->queryParameters['Item.' . ($i + 1) . '.ItemName'] = $Items[$i]['ItemName'];
        }
    }

    public function getClientToken(){
        return $this->clientToken;
    }

    public function setClientToken($clientToken){
        $this->clientToken = $clientToken;
        $this->queryParameters["ClientToken"] = $clientToken;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getRepeatNum(){
        return $this->repeatNum;
    }

    public function setRepeatNum($repeatNum){
        $this->repeatNum = $repeatNum;
        $this->queryParameters["RepeatNum"] = $repeatNum;
    }

    public function getCallbackUrl(){
        return $this->callbackUrl;
    }

    public function setCallbackUrl($callbackUrl){
        $this->callbackUrl = $callbackUrl;
        $this->queryParameters["CallbackUrl"] = $callbackUrl;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}