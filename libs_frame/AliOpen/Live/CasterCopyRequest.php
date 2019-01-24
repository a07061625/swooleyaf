<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterCopyRequest extends RpcAcsRequest {
    private $srcCasterId;
    private $casterName;
    private $clientToken;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "CopyCaster", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSrcCasterId(){
        return $this->srcCasterId;
    }

    public function setSrcCasterId($srcCasterId){
        $this->srcCasterId = $srcCasterId;
        $this->queryParameters["SrcCasterId"] = $srcCasterId;
    }

    public function getCasterName(){
        return $this->casterName;
    }

    public function setCasterName($casterName){
        $this->casterName = $casterName;
        $this->queryParameters["CasterName"] = $casterName;
    }

    public function getClientToken(){
        return $this->clientToken;
    }

    public function setClientToken($clientToken){
        $this->clientToken = $clientToken;
        $this->queryParameters["ClientToken"] = $clientToken;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}