<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterVideoResourceAddRequest extends RpcAcsRequest {
    private $vodUrl;
    private $casterId;
    private $endOffset;
    private $ownerId;
    private $materialId;
    private $beginOffset;
    private $liveStreamUrl;
    private $locationId;
    private $ptsCallbackInterval;
    private $resourceName;
    private $repeatNum;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddCasterVideoResource", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getVodUrl(){
        return $this->vodUrl;
    }

    public function setVodUrl($vodUrl){
        $this->vodUrl = $vodUrl;
        $this->queryParameters["VodUrl"] = $vodUrl;
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getEndOffset(){
        return $this->endOffset;
    }

    public function setEndOffset($endOffset){
        $this->endOffset = $endOffset;
        $this->queryParameters["EndOffset"] = $endOffset;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getMaterialId(){
        return $this->materialId;
    }

    public function setMaterialId($materialId){
        $this->materialId = $materialId;
        $this->queryParameters["MaterialId"] = $materialId;
    }

    public function getBeginOffset(){
        return $this->beginOffset;
    }

    public function setBeginOffset($beginOffset){
        $this->beginOffset = $beginOffset;
        $this->queryParameters["BeginOffset"] = $beginOffset;
    }

    public function getLiveStreamUrl(){
        return $this->liveStreamUrl;
    }

    public function setLiveStreamUrl($liveStreamUrl){
        $this->liveStreamUrl = $liveStreamUrl;
        $this->queryParameters["LiveStreamUrl"] = $liveStreamUrl;
    }

    public function getLocationId(){
        return $this->locationId;
    }

    public function setLocationId($locationId){
        $this->locationId = $locationId;
        $this->queryParameters["LocationId"] = $locationId;
    }

    public function getPtsCallbackInterval(){
        return $this->ptsCallbackInterval;
    }

    public function setPtsCallbackInterval($ptsCallbackInterval){
        $this->ptsCallbackInterval = $ptsCallbackInterval;
        $this->queryParameters["PtsCallbackInterval"] = $ptsCallbackInterval;
    }

    public function getResourceName(){
        return $this->resourceName;
    }

    public function setResourceName($resourceName){
        $this->resourceName = $resourceName;
        $this->queryParameters["ResourceName"] = $resourceName;
    }

    public function getRepeatNum(){
        return $this->repeatNum;
    }

    public function setRepeatNum($repeatNum){
        $this->repeatNum = $repeatNum;
        $this->queryParameters["RepeatNum"] = $repeatNum;
    }
}