<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class TemplateUpdateRequest extends RpcAcsRequest {
    private $container;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $muxConfig;
    private $video;
    private $ownerId;
    private $templateId;
    private $name;
    private $transConfig;
    private $audio;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "UpdateTemplate", "mts", "openAPI");
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

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getTemplateId(){
        return $this->templateId;
    }

    public function setTemplateId($templateId){
        $this->templateId = $templateId;
        $this->queryParameters["TemplateId"] = $templateId;
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

    public function getAudio(){
        return $this->audio;
    }

    public function setAudio($audio){
        $this->audio = $audio;
        $this->queryParameters["Audio"] = $audio;
    }
}