<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class UploadImageCreateRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $imageType;
    private $originalFileName;
    private $resourceOwnerAccount;
    private $imageExt;
    private $cateId;
    private $ownerId;
    private $title;
    private $tags;
    private $storageLocation;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "CreateUploadImage", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getImageType(){
        return $this->imageType;
    }

    public function setImageType($imageType){
        $this->imageType = $imageType;
        $this->queryParameters["ImageType"] = $imageType;
    }

    public function getOriginalFileName(){
        return $this->originalFileName;
    }

    public function setOriginalFileName($originalFileName){
        $this->originalFileName = $originalFileName;
        $this->queryParameters["OriginalFileName"] = $originalFileName;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getImageExt(){
        return $this->imageExt;
    }

    public function setImageExt($imageExt){
        $this->imageExt = $imageExt;
        $this->queryParameters["ImageExt"] = $imageExt;
    }

    public function getCateId(){
        return $this->cateId;
    }

    public function setCateId($cateId){
        $this->cateId = $cateId;
        $this->queryParameters["CateId"] = $cateId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        $this->queryParameters["Title"] = $title;
    }

    public function getTags(){
        return $this->tags;
    }

    public function setTags($tags){
        $this->tags = $tags;
        $this->queryParameters["Tags"] = $tags;
    }

    public function getStorageLocation(){
        return $this->storageLocation;
    }

    public function setStorageLocation($storageLocation){
        $this->storageLocation = $storageLocation;
        $this->queryParameters["StorageLocation"] = $storageLocation;
    }
}