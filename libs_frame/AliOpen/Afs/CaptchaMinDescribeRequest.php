<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

class CaptchaMinDescribeRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $sourceIp;
    private $configName;
    private $time;
    private $type;

    public function __construct(){
        parent::__construct("afs", "2018-01-12", "DescribeCaptchaMin");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getSourceIp(){
        return $this->sourceIp;
    }

    public function setSourceIp($sourceIp){
        $this->sourceIp = $sourceIp;
        $this->queryParameters["SourceIp"] = $sourceIp;
    }

    public function getConfigName(){
        return $this->configName;
    }

    public function setConfigName($configName){
        $this->configName = $configName;
        $this->queryParameters["ConfigName"] = $configName;
    }

    public function getTime(){
        return $this->time;
    }

    public function setTime($time){
        $this->time = $time;
        $this->queryParameters["Time"] = $time;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
        $this->queryParameters["Type"] = $type;
    }
}