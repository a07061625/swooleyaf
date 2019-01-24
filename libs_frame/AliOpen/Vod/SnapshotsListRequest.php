<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class SnapshotsListRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $snapshotType;
    private $pageNo;
    private $pageSize;
    private $videoId;
    private $ownerId;
    private $authTimeout;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "ListSnapshots", "vod", "openAPI");
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

    public function getSnapshotType(){
        return $this->snapshotType;
    }

    public function setSnapshotType($snapshotType){
        $this->snapshotType = $snapshotType;
        $this->queryParameters["SnapshotType"] = $snapshotType;
    }

    public function getPageNo(){
        return $this->pageNo;
    }

    public function setPageNo($pageNo){
        $this->pageNo = $pageNo;
        $this->queryParameters["PageNo"] = $pageNo;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getVideoId(){
        return $this->videoId;
    }

    public function setVideoId($videoId){
        $this->videoId = $videoId;
        $this->queryParameters["VideoId"] = $videoId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getAuthTimeout(){
        return $this->authTimeout;
    }

    public function setAuthTimeout($authTimeout){
        $this->authTimeout = $authTimeout;
        $this->queryParameters["AuthTimeout"] = $authTimeout;
    }
}