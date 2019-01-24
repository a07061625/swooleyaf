<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class TemplateAddRequest extends RpcAcsRequest {
    private $container;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $name;
    private $transConfig;
    private $muxConfig;
    private $video;
    private $audio;
    private $ownerId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "AddTemplate", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getContainer(){
        return $this->container;
    }

    public function setContainer($container){
        $this->container = $container;
        $this->queryParameters["Container"] = $container;
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

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        $this->queryParameters["Name"] = $name;
    }

    public function getTransConfig(){
        return $this->transConfig;
    }

    public function setTransConfig($transConfig){
        $this->transConfig = $transConfig;
        $this->queryParameters["TransConfig"] = $transConfig;
    }

    public function getMuxConfig(){
        return $this->muxConfig;
    }

    public function setMuxConfig($muxConfig){
        $this->muxConfig = $muxConfig;
        $this->queryParameters["MuxConfig"] = $muxConfig;
    }

    public function getVideo(){
        return $this->video;
    }

    public function setVideo($video){
        $this->video = $video;
        $this->queryParameters["Video"] = $video;
    }

    public function getAudio(){
        return $this->audio;
    }

    public function setAudio($audio){
        $this->audio = $audio;
        $this->queryParameters["Audio"] = $audio;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}