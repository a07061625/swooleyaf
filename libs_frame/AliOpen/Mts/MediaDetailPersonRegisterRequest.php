<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class MediaDetailPersonRegisterRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $images;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $personLib;
    private $ownerId;
    private $category;
    private $personName;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "RegisterMediaDetailPerson", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getImages(){
        return $this->images;
    }

    public function setImages($images){
        $this->images = $images;
        $this->queryParameters["Images"] = $images;
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

    public function getPersonLib(){
        return $this->personLib;
    }

    public function setPersonLib($personLib){
        $this->personLib = $personLib;
        $this->queryParameters["PersonLib"] = $personLib;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
        $this->queryParameters["Category"] = $category;
    }

    public function getPersonName(){
        return $this->personName;
    }

    public function setPersonName($personName){
        $this->personName = $personName;
        $this->queryParameters["PersonName"] = $personName;
    }
}