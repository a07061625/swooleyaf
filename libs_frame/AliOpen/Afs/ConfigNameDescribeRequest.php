<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

class ConfigNameDescribeRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $sourceIp;

    public function __construct(){
        parent::__construct("afs", "2018-01-12", "DescribeConfigName");
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
}