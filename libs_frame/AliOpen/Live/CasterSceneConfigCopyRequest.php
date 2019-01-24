<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterSceneConfigCopyRequest extends RpcAcsRequest {
    private $fromSceneId;
    private $casterId;
    private $ownerId;
    private $toSceneId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "CopyCasterSceneConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getFromSceneId(){
        return $this->fromSceneId;
    }

    public function setFromSceneId($fromSceneId){
        $this->fromSceneId = $fromSceneId;
        $this->queryParameters["FromSceneId"] = $fromSceneId;
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getToSceneId(){
        return $this->toSceneId;
    }

    public function setToSceneId($toSceneId){
        $this->toSceneId = $toSceneId;
        $this->queryParameters["ToSceneId"] = $toSceneId;
    }
}