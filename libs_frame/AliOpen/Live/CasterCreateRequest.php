<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterCreateRequest extends RpcAcsRequest {
    private $casterTemplate;
    private $expireTime;
    private $normType;
    private $casterName;
    private $clientToken;
    private $chargeType;
    private $ownerId;
    private $purchaseTime;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "CreateCaster", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getCasterTemplate(){
        return $this->casterTemplate;
    }

    public function setCasterTemplate($casterTemplate){
        $this->casterTemplate = $casterTemplate;
        $this->queryParameters["CasterTemplate"] = $casterTemplate;
    }

    public function getExpireTime(){
        return $this->expireTime;
    }

    public function setExpireTime($expireTime){
        $this->expireTime = $expireTime;
        $this->queryParameters["ExpireTime"] = $expireTime;
    }

    public function getNormType(){
        return $this->normType;
    }

    public function setNormType($normType){
        $this->normType = $normType;
        $this->queryParameters["NormType"] = $normType;
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

    public function getChargeType(){
        return $this->chargeType;
    }

    public function setChargeType($chargeType){
        $this->chargeType = $chargeType;
        $this->queryParameters["ChargeType"] = $chargeType;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getPurchaseTime(){
        return $this->purchaseTime;
    }

    public function setPurchaseTime($purchaseTime){
        $this->purchaseTime = $purchaseTime;
        $this->queryParameters["PurchaseTime"] = $purchaseTime;
    }
}