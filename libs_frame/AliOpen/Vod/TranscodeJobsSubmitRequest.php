<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class TranscodeJobsSubmitRequest extends RpcAcsRequest {
    private $resourceOwnerId;
    private $templateGroupId;
    private $resourceOwnerAccount;
    private $videoId;
    private $overrideParams;
    private $ownerId;
    private $encryptConfig;
    private $pipelineId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "SubmitTranscodeJobs", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getTemplateGroupId(){
        return $this->templateGroupId;
    }

    public function setTemplateGroupId($templateGroupId){
        $this->templateGroupId = $templateGroupId;
        $this->queryParameters["TemplateGroupId"] = $templateGroupId;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getVideoId(){
        return $this->videoId;
    }

    public function setVideoId($videoId){
        $this->videoId = $videoId;
        $this->queryParameters["VideoId"] = $videoId;
    }

    public function getOverrideParams(){
        return $this->overrideParams;
    }

    public function setOverrideParams($overrideParams){
        $this->overrideParams = $overrideParams;
        $this->queryParameters["OverrideParams"] = $overrideParams;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getEncryptConfig(){
        return $this->encryptConfig;
    }

    public function setEncryptConfig($encryptConfig){
        $this->encryptConfig = $encryptConfig;
        $this->queryParameters["EncryptConfig"] = $encryptConfig;
    }

    public function getPipelineId(){
        return $this->pipelineId;
    }

    public function setPipelineId($pipelineId){
        $this->pipelineId = $pipelineId;
        $this->queryParameters["PipelineId"] = $pipelineId;
    }
}