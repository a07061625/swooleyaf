<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class OSSStatisGetRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $startStatisTime;
    private $resourceOwnerAccount;
    private $level;
    private $ownerAccount;
    private $ownerId;
    private $endStatisTime;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "GetOSSStatis", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getStartStatisTime(){
        return $this->startStatisTime;
    }

    public function setStartStatisTime($startStatisTime){
        $this->startStatisTime = $startStatisTime;
        $this->queryParameters["StartStatisTime"] = $startStatisTime;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getLevel(){
        return $this->level;
    }

    public function setLevel($level){
        $this->level = $level;
        $this->queryParameters["Level"] = $level;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getEndStatisTime(){
        return $this->endStatisTime;
    }

    public function setEndStatisTime($endStatisTime){
        $this->endStatisTime = $endStatisTime;
        $this->queryParameters["EndStatisTime"] = $endStatisTime;
    }
}