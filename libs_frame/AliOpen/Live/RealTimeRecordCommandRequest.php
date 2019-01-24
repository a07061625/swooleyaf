<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class RealTimeRecordCommandRequest extends RpcAcsRequest {
    private $appName;
    private $domainName;
    private $ownerId;
    private $command;
    private $streamName;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "RealTimeRecordCommand", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getCommand(){
        return $this->command;
    }

    public function setCommand($command){
        $this->command = $command;
        $this->queryParameters["Command"] = $command;
    }

    public function getStreamName(){
        return $this->streamName;
    }

    public function setStreamName($streamName){
        $this->streamName = $streamName;
        $this->queryParameters["StreamName"] = $streamName;
    }
}