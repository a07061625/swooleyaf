<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterLayoutModifyRequest extends RpcAcsRequest {
    private $BlendLists;
    private $AudioLayers;
    private $VideoLayers;
    private $casterId;
    private $MixLists;
    private $ownerId;
    private $layoutId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "ModifyCasterLayout", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getBlendLists(){
        return $this->BlendLists;
    }

    public function setBlendLists($BlendLists){
        $this->BlendLists = $BlendLists;
        for ($i = 0; $i < count($BlendLists); $i ++) {
            $this->queryParameters["BlendList." . ($i + 1)] = $BlendLists[$i];
        }
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

    public function getVideoLayers(){
        return $this->VideoLayers;
    }

    public function setVideoLayers($VideoLayers){
        $this->VideoLayers = $VideoLayers;
        for ($i = 0; $i < count($VideoLayers); $i ++) {
            $this->queryParameters['VideoLayer.' . ($i + 1) . '.FillMode'] = $VideoLayers[$i]['FillMode'];
            $this->queryParameters['VideoLayer.' . ($i + 1) . '.WidthNormalized'] = $VideoLayers[$i]['WidthNormalized'];
            $this->queryParameters['VideoLayer.' . ($i + 1) . '.FixedDelayDuration'] = $VideoLayers[$i]['FixedDelayDuration'];
            $this->queryParameters['VideoLayer.' . ($i + 1) . '.PositionRefer'] = $VideoLayers[$i]['PositionRefer'];
            for ($j = 0; $j < count($VideoLayers[$i]['PositionNormalizeds']); $j ++) {
                $this->queryParameters['VideoLayer.' . ($i + 1) . '.PositionNormalized.' . ($j + 1)] =
                    $VideoLayers[$i]['PositionNormalizeds'][$j];
            }
            $this->queryParameters['VideoLayer.' . ($i + 1) . '.HeightNormalized'] = $VideoLayers[$i]['HeightNormalized'];
        }
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
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

    public function getLayoutId(){
        return $this->layoutId;
    }

    public function setLayoutId($layoutId){
        $this->layoutId = $layoutId;
        $this->queryParameters["LayoutId"] = $layoutId;
    }
}