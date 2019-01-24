<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterComponentModifyRequest extends RpcAcsRequest {
    private $componentId;
    private $componentType;
    private $imageLayerContent;
    private $casterId;
    private $effect;
    private $componentLayer;
    private $captionLayerContent;
    private $componentName;
    private $ownerId;
    private $textLayerContent;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "ModifyCasterComponent", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getComponentId(){
        return $this->componentId;
    }

    public function setComponentId($componentId){
        $this->componentId = $componentId;
        $this->queryParameters["ComponentId"] = $componentId;
    }

    public function getComponentType(){
        return $this->componentType;
    }

    public function setComponentType($componentType){
        $this->componentType = $componentType;
        $this->queryParameters["ComponentType"] = $componentType;
    }

    public function getImageLayerContent(){
        return $this->imageLayerContent;
    }

    public function setImageLayerContent($imageLayerContent){
        $this->imageLayerContent = $imageLayerContent;
        $this->queryParameters["ImageLayerContent"] = $imageLayerContent;
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getEffect(){
        return $this->effect;
    }

    public function setEffect($effect){
        $this->effect = $effect;
        $this->queryParameters["Effect"] = $effect;
    }

    public function getComponentLayer(){
        return $this->componentLayer;
    }

    public function setComponentLayer($componentLayer){
        $this->componentLayer = $componentLayer;
        $this->queryParameters["ComponentLayer"] = $componentLayer;
    }

    public function getCaptionLayerContent(){
        return $this->captionLayerContent;
    }

    public function setCaptionLayerContent($captionLayerContent){
        $this->captionLayerContent = $captionLayerContent;
        $this->queryParameters["CaptionLayerContent"] = $captionLayerContent;
    }

    public function getComponentName(){
        return $this->componentName;
    }

    public function setComponentName($componentName){
        $this->componentName = $componentName;
        $this->queryParameters["ComponentName"] = $componentName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getTextLayerContent(){
        return $this->textLayerContent;
    }

    public function setTextLayerContent($textLayerContent){
        $this->textLayerContent = $textLayerContent;
        $this->queryParameters["TextLayerContent"] = $textLayerContent;
    }
}