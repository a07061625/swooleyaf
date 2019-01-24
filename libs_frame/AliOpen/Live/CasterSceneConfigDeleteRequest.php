<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterSceneConfigDeleteRequest extends RpcAcsRequest {
    private $casterId;
    private $sceneId;
    private $ownerId;
    private $type;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DeleteCasterSceneConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getSceneId(){
        return $this->sceneId;
    }

    public function setSceneId($sceneId){
        $this->sceneId = $sceneId;
        $this->queryParameters["SceneId"] = $sceneId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
        $this->queryParameters["Type"] = $type;
    }
}