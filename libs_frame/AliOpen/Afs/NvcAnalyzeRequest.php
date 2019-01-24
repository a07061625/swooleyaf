<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

class NvcAnalyzeRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $sourceIp;
    private $data;
    private $scoreJsonStr;

    public function __construct(){
        parent::__construct("afs", "2018-01-12", "AnalyzeNvc");
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

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
        $this->queryParameters["Data"] = $data;
    }

    public function getScoreJsonStr(){
        return $this->scoreJsonStr;
    }

    public function setScoreJsonStr($scoreJsonStr){
        $this->scoreJsonStr = $scoreJsonStr;
        $this->queryParameters["ScoreJsonStr"] = $scoreJsonStr;
    }
}