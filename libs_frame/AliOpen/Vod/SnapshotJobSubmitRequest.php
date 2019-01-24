<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class SnapshotJobSubmitRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $count;
    private $videoId;
    private $ownerId;
    private $specifiedOffsetTime;
    private $width;
    private $interval;
    private $spriteSnapshotConfig;
    private $snapshotTemplateId;
    private $height;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "SubmitSnapshotJob", "vod", "openAPI");
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

    public function getCount(){
        return $this->count;
    }

    public function setCount($count){
        $this->count = $count;
        $this->queryParameters["Count"] = $count;
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

    public function getSpecifiedOffsetTime(){
        return $this->specifiedOffsetTime;
    }

    public function setSpecifiedOffsetTime($specifiedOffsetTime){
        $this->specifiedOffsetTime = $specifiedOffsetTime;
        $this->queryParameters["SpecifiedOffsetTime"] = $specifiedOffsetTime;
    }

    public function getWidth(){
        return $this->width;
    }

    public function setWidth($width){
        $this->width = $width;
        $this->queryParameters["Width"] = $width;
    }

    public function getInterval(){
        return $this->interval;
    }

    public function setInterval($interval){
        $this->interval = $interval;
        $this->queryParameters["Interval"] = $interval;
    }

    public function getSpriteSnapshotConfig(){
        return $this->spriteSnapshotConfig;
    }

    public function setSpriteSnapshotConfig($spriteSnapshotConfig){
        $this->spriteSnapshotConfig = $spriteSnapshotConfig;
        $this->queryParameters["SpriteSnapshotConfig"] = $spriteSnapshotConfig;
    }

    public function getSnapshotTemplateId(){
        return $this->snapshotTemplateId;
    }

    public function setSnapshotTemplateId($snapshotTemplateId){
        $this->snapshotTemplateId = $snapshotTemplateId;
        $this->queryParameters["SnapshotTemplateId"] = $snapshotTemplateId;
    }

    public function getHeight(){
        return $this->height;
    }

    public function setHeight($height){
        $this->height = $height;
        $this->queryParameters["Height"] = $height;
    }
}