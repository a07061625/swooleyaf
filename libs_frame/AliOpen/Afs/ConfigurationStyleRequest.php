<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

class ConfigurationStyleRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $sourceIp;
    private $configurationMethod;
    private $applyType;
    private $scene;

    public function __construct(){
        parent::__construct("afs", "2018-01-12", "ConfigurationStyle");
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

    public function getConfigurationMethod(){
        return $this->configurationMethod;
    }

    public function setConfigurationMethod($configurationMethod){
        $this->configurationMethod = $configurationMethod;
        $this->queryParameters["ConfigurationMethod"] = $configurationMethod;
    }

    public function getApplyType(){
        return $this->applyType;
    }

    public function setApplyType($applyType){
        $this->applyType = $applyType;
        $this->queryParameters["ApplyType"] = $applyType;
    }

    public function getScene(){
        return $this->scene;
    }

    public function setScene($scene){
        $this->scene = $scene;
        $this->queryParameters["Scene"] = $scene;
    }
}