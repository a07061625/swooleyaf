<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class MediaListByURLQueryRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $includeSummaryList;
    private $resourceOwnerAccount;
    private $includeSnapshotList;
    private $fileURLs;
    private $ownerAccount;
    private $ownerId;
    private $includePlayList;
    private $includeMediaInfo;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "QueryMediaListByURL", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getIncludeSummaryList(){
        return $this->includeSummaryList;
    }

    public function setIncludeSummaryList($includeSummaryList){
        $this->includeSummaryList = $includeSummaryList;
        $this->queryParameters["IncludeSummaryList"] = $includeSummaryList;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getIncludeSnapshotList(){
        return $this->includeSnapshotList;
    }

    public function setIncludeSnapshotList($includeSnapshotList){
        $this->includeSnapshotList = $includeSnapshotList;
        $this->queryParameters["IncludeSnapshotList"] = $includeSnapshotList;
    }

    public function getFileURLs(){
        return $this->fileURLs;
    }

    public function setFileURLs($fileURLs){
        $this->fileURLs = $fileURLs;
        $this->queryParameters["FileURLs"] = $fileURLs;
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

    public function getIncludePlayList(){
        return $this->includePlayList;
    }

    public function setIncludePlayList($includePlayList){
        $this->includePlayList = $includePlayList;
        $this->queryParameters["IncludePlayList"] = $includePlayList;
    }

    public function getIncludeMediaInfo(){
        return $this->includeMediaInfo;
    }

    public function setIncludeMediaInfo($includeMediaInfo){
        $this->includeMediaInfo = $includeMediaInfo;
        $this->queryParameters["IncludeMediaInfo"] = $includeMediaInfo;
    }
}