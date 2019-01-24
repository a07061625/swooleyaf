<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class KeyDecryptRequest extends RpcAcsRequest {
    private $rand;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $ownerId;
    private $ciphertextBlob;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "DecryptKey", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getRand(){
        return $this->rand;
    }

    public function setRand($rand){
        $this->rand = $rand;
        $this->queryParameters["Rand"] = $rand;
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

    public function getCiphertextBlob(){
        return $this->ciphertextBlob;
    }

    public function setCiphertextBlob($ciphertextBlob){
        $this->ciphertextBlob = $ciphertextBlob;
        $this->queryParameters["CiphertextBlob"] = $ciphertextBlob;
    }
}