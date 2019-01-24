<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterVideoResourceEffectRequest extends RpcAcsRequest {
    private $resourceId;
    private $casterId;
    private $sceneId;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "EffectCasterVideoResource", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceId(){
        return $this->resourceId;
    }

    public function setResourceId($resourceId){
        $this->resourceId = $resourceId;
        $this->queryParameters["ResourceId"] = $resourceId;
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
}