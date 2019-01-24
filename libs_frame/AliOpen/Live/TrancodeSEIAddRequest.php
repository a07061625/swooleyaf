<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class TrancodeSEIAddRequest extends RpcAcsRequest {
    private $delay;
    private $appName;
    private $repeat;
    private $domainName;
    private $pattern;
    private $text;
    private $ownerId;
    private $streamName;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddTrancodeSEI", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getDelay(){
        return $this->delay;
    }

    public function setDelay($delay){
        $this->delay = $delay;
        $this->queryParameters["Delay"] = $delay;
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }

    public function getRepeat(){
        return $this->repeat;
    }

    public function setRepeat($repeat){
        $this->repeat = $repeat;
        $this->queryParameters["Repeat"] = $repeat;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getPattern(){
        return $this->pattern;
    }

    public function setPattern($pattern){
        $this->pattern = $pattern;
        $this->queryParameters["Pattern"] = $pattern;
    }

    public function getText(){
        return $this->text;
    }

    public function setText($text){
        $this->text = $text;
        $this->queryParameters["Text"] = $text;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getStreamName(){
        return $this->streamName;
    }

    public function setStreamName($streamName){
        $this->streamName = $streamName;
        $this->queryParameters["StreamName"] = $streamName;
    }
}