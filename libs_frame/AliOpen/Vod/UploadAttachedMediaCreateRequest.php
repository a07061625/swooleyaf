<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class UploadAttachedMediaCreateRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $description;
    private $fileSize;
    private $ownerId;
    private $title;
    private $businessType;
    private $tags;
    private $storageLocation;
    private $mediaExt;
    private $fileName;
    private $cateId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "CreateUploadAttachedMedia", "vod", "openAPI");
        $this->setMethod("POST");
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

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
        $this->queryParameters["Description"] = $description;
    }

    public function getFileSize(){
        return $this->fileSize;
    }

    public function setFileSize($fileSize){
        $this->fileSize = $fileSize;
        $this->queryParameters["FileSize"] = $fileSize;
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

    public function getBusinessType(){
        return $this->businessType;
    }

    public function setBusinessType($businessType){
        $this->businessType = $businessType;
        $this->queryParameters["BusinessType"] = $businessType;
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

    public function getMediaExt(){
        return $this->mediaExt;
    }

    public function setMediaExt($mediaExt){
        $this->mediaExt = $mediaExt;
        $this->queryParameters["MediaExt"] = $mediaExt;
    }

    public function getFileName(){
        return $this->fileName;
    }

    public function setFileName($fileName){
        $this->fileName = $fileName;
        $this->queryParameters["FileName"] = $fileName;
    }

    public function getCateId(){
        return $this->cateId;
    }

    public function setCateId($cateId){
        $this->cateId = $cateId;
        $this->queryParameters["CateId"] = $cateId;
    }
}