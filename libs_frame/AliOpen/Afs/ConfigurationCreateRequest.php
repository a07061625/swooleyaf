<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

class ConfigurationCreateRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $sourceIp;
    private $configurationName;
    private $maxPV;
    private $configurationMethod;
    private $applyType;
    private $scene;

    public function __construct(){
        parent::__construct("afs", "2018-01-12", "CreateConfiguration");
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

    public function getConfigurationName(){
        return $this->configurationName;
    }

    public function setConfigurationName($configurationName){
        $this->configurationName = $configurationName;
        $this->queryParameters["ConfigurationName"] = $configurationName;
    }

    public function getMaxPV(){
        return $this->maxPV;
    }

    public function setMaxPV($maxPV){
        $this->maxPV = $maxPV;
        $this->queryParameters["MaxPV"] = $maxPV;
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