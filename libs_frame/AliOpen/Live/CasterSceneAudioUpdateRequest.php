<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterSceneAudioUpdateRequest extends RpcAcsRequest {
    private $AudioLayers;
    private $casterId;
    private $sceneId;
    private $MixLists;
    private $ownerId;
    private $followEnable;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "UpdateCasterSceneAudio", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getAudioLayers(){
        return $this->AudioLayers;
    }

    public function setAudioLayers($AudioLayers){
        $this->AudioLayers = $AudioLayers;
        for ($i = 0; $i < count($AudioLayers); $i ++) {
            $this->queryParameters['AudioLayer.' . ($i + 1) . '.FixedDelayDuration'] = $AudioLayers[$i]['FixedDelayDuration'];
            $this->queryParameters['AudioLayer.' . ($i + 1) . '.VolumeRate'] = $AudioLayers[$i]['VolumeRate'];
            $this->queryParameters['AudioLayer.' . ($i + 1) . '.ValidChannel'] = $AudioLayers[$i]['ValidChannel'];
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

    public function getMixLists(){
        return $this->MixLists;
    }

    public function setMixLists($MixLists){
        $this->MixLists = $MixLists;
        for ($i = 0; $i < count($MixLists); $i ++) {
            $this->queryParameters["MixList." . ($i + 1)] = $MixLists[$i];
        }
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getFollowEnable(){
        return $this->followEnable;
    }

    public function setFollowEnable($followEnable){
        $this->followEnable = $followEnable;
        $this->queryParameters["FollowEnable"] = $followEnable;
    }
}