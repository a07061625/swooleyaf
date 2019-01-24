<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

class PersonMachineListDescribeRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $sourceIp;

    public function __construct(){
        parent::__construct("afs", "2018-01-12", "DescribePersonMachineList");
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