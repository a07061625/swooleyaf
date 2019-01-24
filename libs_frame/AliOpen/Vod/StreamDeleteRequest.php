<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class StreamDeleteRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $jobIds;
    private $videoId;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "DeleteStream", "vod", "openAPI");
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

    public function getJobIds(){
        return $this->jobIds;
    }

    public function setJobIds($jobIds){
        $this->jobIds = $jobIds;
        $this->queryParameters["JobIds"] = $jobIds;
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
}