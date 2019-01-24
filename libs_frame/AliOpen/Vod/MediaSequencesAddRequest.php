<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class MediaSequencesAddRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $mediaURL;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $mediaSequences;
    private $ownerId;
    private $mediaId;
    private $mediaType;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "AddMediaSequences", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getMediaURL(){
        return $this->mediaURL;
    }

    public function setMediaURL($mediaURL){
        $this->mediaURL = $mediaURL;
        $this->queryParameters["MediaURL"] = $mediaURL;
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

    public function getMediaSequences(){
        return $this->mediaSequences;
    }

    public function setMediaSequences($mediaSequences){
        $this->mediaSequences = $mediaSequences;
        $this->queryParameters["MediaSequences"] = $mediaSequences;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getMediaId(){
        return $this->mediaId;
    }

    public function setMediaId($mediaId){
        $this->mediaId = $mediaId;
        $this->queryParameters["MediaId"] = $mediaId;
    }

    public function getMediaType(){
        return $this->mediaType;
    }

    public function setMediaType($mediaType){
        $this->mediaType = $mediaType;
        $this->queryParameters["MediaType"] = $mediaType;
    }
}