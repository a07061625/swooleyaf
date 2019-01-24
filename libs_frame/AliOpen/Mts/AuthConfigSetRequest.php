<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class AuthConfigSetRequest extends RpcAcsRequest {
    private $key1;
    private $key2;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "SetAuthConfig", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getKey1(){
        return $this->key1;
    }

    public function setKey1($key1){
        $this->key1 = $key1;
        $this->queryParameters["Key1"] = $key1;
    }

    public function getKey2(){
        return $this->key2;
    }

    public function setKey2($key2){
        $this->key2 = $key2;
        $this->queryParameters["Key2"] = $key2;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
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
}