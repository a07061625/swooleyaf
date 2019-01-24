<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class MediaListRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $nextPageToken;
    private $ownerAccount;
    private $maximumPageSize;
    private $from;
    private $to;
    private $ownerId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "ListMedia", "mts", "openAPI");
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

    public function getNextPageToken(){
        return $this->nextPageToken;
    }

    public function setNextPageToken($nextPageToken){
        $this->nextPageToken = $nextPageToken;
        $this->queryParameters["NextPageToken"] = $nextPageToken;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getMaximumPageSize(){
        return $this->maximumPageSize;
    }

    public function setMaximumPageSize($maximumPageSize){
        $this->maximumPageSize = $maximumPageSize;
        $this->queryParameters["MaximumPageSize"] = $maximumPageSize;
    }

    public function getFrom(){
        return $this->from;
    }

    public function setFrom($from){
        $this->from = $from;
        $this->queryParameters["From"] = $from;
    }

    public function getTo(){
        return $this->to;
    }

    public function setTo($to){
        $this->to = $to;
        $this->queryParameters["To"] = $to;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}