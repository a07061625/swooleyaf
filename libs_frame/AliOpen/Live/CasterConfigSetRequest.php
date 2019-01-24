<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterConfigSetRequest extends RpcAcsRequest {
    private $sideOutputUrl;
    private $casterId;
    private $channelEnable;
    private $domainName;
    private $programEffect;
    private $programName;
    private $ownerId;
    private $recordConfig;
    private $urgentMaterialId;
    private $transcodeConfig;
    private $delay;
    private $casterName;
    private $callbackUrl;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "SetCasterConfig", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getSideOutputUrl(){
        return $this->sideOutputUrl;
    }

    public function setSideOutputUrl($sideOutputUrl){
        $this->sideOutputUrl = $sideOutputUrl;
        $this->queryParameters["SideOutputUrl"] = $sideOutputUrl;
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getChannelEnable(){
        return $this->channelEnable;
    }

    public function setChannelEnable($channelEnable){
        $this->channelEnable = $channelEnable;
        $this->queryParameters["ChannelEnable"] = $channelEnable;
    }

    public function getDomainName(){
        return $this->domainName;
    }

    public function setDomainName($domainName){
        $this->domainName = $domainName;
        $this->queryParameters["DomainName"] = $domainName;
    }

    public function getProgramEffect(){
        return $this->programEffect;
    }

    public function setProgramEffect($programEffect){
        $this->programEffect = $programEffect;
        $this->queryParameters["ProgramEffect"] = $programEffect;
    }

    public function getProgramName(){
        return $this->programName;
    }

    public function setProgramName($programName){
        $this->programName = $programName;
        $this->queryParameters["ProgramName"] = $programName;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getRecordConfig(){
        return $this->recordConfig;
    }

    public function setRecordConfig($recordConfig){
        $this->recordConfig = $recordConfig;
        $this->queryParameters["RecordConfig"] = $recordConfig;
    }

    public function getUrgentMaterialId(){
        return $this->urgentMaterialId;
    }

    public function setUrgentMaterialId($urgentMaterialId){
        $this->urgentMaterialId = $urgentMaterialId;
        $this->queryParameters["UrgentMaterialId"] = $urgentMaterialId;
    }

    public function getTranscodeConfig(){
        return $this->transcodeConfig;
    }

    public function setTranscodeConfig($transcodeConfig){
        $this->transcodeConfig = $transcodeConfig;
        $this->queryParameters["TranscodeConfig"] = $transcodeConfig;
    }

    public function getDelay(){
        return $this->delay;
    }

    public function setDelay($delay){
        $this->delay = $delay;
        $this->queryParameters["Delay"] = $delay;
    }

    public function getCasterName(){
        return $this->casterName;
    }

    public function setCasterName($casterName){
        $this->casterName = $casterName;
        $this->queryParameters["CasterName"] = $casterName;
    }

    public function getCallbackUrl(){
        return $this->callbackUrl;
    }

    public function setCallbackUrl($callbackUrl){
        $this->callbackUrl = $callbackUrl;
        $this->queryParameters["CallbackUrl"] = $callbackUrl;
    }
}