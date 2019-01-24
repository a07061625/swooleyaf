<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

class EarlyWarningSetRequest extends RpcAcsRequest {
    private $timeEnd;
    private $resourceOwnerId;
    private $warnOpen;
    private $sourceIp;
    private $channel;
    private $title;
    private $timeOpen;
    private $timeBegin;
    private $frequency;

    public function __construct(){
        parent::__construct("afs", "2018-01-12", "SetEarlyWarning");
        $this->setMethod("POST");
    }

    public function getTimeEnd(){
        return $this->timeEnd;
    }

    public function setTimeEnd($timeEnd){
        $this->timeEnd = $timeEnd;
        $this->queryParameters["TimeEnd"] = $timeEnd;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getWarnOpen(){
        return $this->warnOpen;
    }

    public function setWarnOpen($warnOpen){
        $this->warnOpen = $warnOpen;
        $this->queryParameters["WarnOpen"] = $warnOpen;
    }

    public function getSourceIp(){
        return $this->sourceIp;
    }

    public function setSourceIp($sourceIp){
        $this->sourceIp = $sourceIp;
        $this->queryParameters["SourceIp"] = $sourceIp;
    }

    public function getChannel(){
        return $this->channel;
    }

    public function setChannel($channel){
        $this->channel = $channel;
        $this->queryParameters["Channel"] = $channel;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        $this->queryParameters["Title"] = $title;
    }

    public function getTimeOpen(){
        return $this->timeOpen;
    }

    public function setTimeOpen($timeOpen){
        $this->timeOpen = $timeOpen;
        $this->queryParameters["TimeOpen"] = $timeOpen;
    }

    public function getTimeBegin(){
        return $this->timeBegin;
    }

    public function setTimeBegin($timeBegin){
        $this->timeBegin = $timeBegin;
        $this->queryParameters["TimeBegin"] = $timeBegin;
    }

    public function getFrequency(){
        return $this->frequency;
    }

    public function setFrequency($frequency){
        $this->frequency = $frequency;
        $this->queryParameters["Frequency"] = $frequency;
    }
}