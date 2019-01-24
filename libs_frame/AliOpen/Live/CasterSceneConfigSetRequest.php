<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterSceneConfigSetRequest extends RpcAcsRequest {
    private $ComponentIds;
    private $casterId;
    private $sceneId;
    private $ownerId;
    private $layoutId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "SetCasterSceneConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getComponentIds(){
        return $this->ComponentIds;
    }

    public function setComponentIds($ComponentIds){
        $this->ComponentIds = $ComponentIds;
        for ($i = 0; $i < count($ComponentIds); $i ++) {
            $this->queryParameters["ComponentId." . ($i + 1)] = $ComponentIds[$i];
        }
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

    public function getLayoutId(){
        return $this->layoutId;
    }

    public function setLayoutId($layoutId){
        $this->layoutId = $layoutId;
        $this->queryParameters["LayoutId"] = $layoutId;
    }
}