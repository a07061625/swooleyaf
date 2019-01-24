<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CustomLiveStreamTranscodeAddRequest extends RpcAcsRequest {
    private $app;
    private $template;
    private $profile;
    private $fPS;
    private $gop;
    private $ownerId;
    private $templateType;
    private $audioBitrate;
    private $domain;
    private $width;
    private $videoBitrate;
    private $height;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddCustomLiveStreamTranscode", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getApp(){
        return $this->app;
    }

    public function setApp($app){
        $this->app = $app;
        $this->queryParameters["App"] = $app;
    }

    public function getTemplate(){
        return $this->template;
    }

    public function setTemplate($template){
        $this->template = $template;
        $this->queryParameters["Template"] = $template;
    }

    public function getProfile(){
        return $this->profile;
    }

    public function setProfile($profile){
        $this->profile = $profile;
        $this->queryParameters["Profile"] = $profile;
    }

    public function getFPS(){
        return $this->fPS;
    }

    public function setFPS($fPS){
        $this->fPS = $fPS;
        $this->queryParameters["FPS"] = $fPS;
    }

    public function getGop(){
        return $this->gop;
    }

    public function setGop($gop){
        $this->gop = $gop;
        $this->queryParameters["Gop"] = $gop;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getTemplateType(){
        return $this->templateType;
    }

    public function setTemplateType($templateType){
        $this->templateType = $templateType;
        $this->queryParameters["TemplateType"] = $templateType;
    }

    public function getAudioBitrate(){
        return $this->audioBitrate;
    }

    public function setAudioBitrate($audioBitrate){
        $this->audioBitrate = $audioBitrate;
        $this->queryParameters["AudioBitrate"] = $audioBitrate;
    }

    public function getDomain(){
        return $this->domain;
    }

    public function setDomain($domain){
        $this->domain = $domain;
        $this->queryParameters["Domain"] = $domain;
    }

    public function getWidth(){
        return $this->width;
    }

    public function setWidth($width){
        $this->width = $width;
        $this->queryParameters["Width"] = $width;
    }

    public function getVideoBitrate(){
        return $this->videoBitrate;
    }

    public function setVideoBitrate($videoBitrate){
        $this->videoBitrate = $videoBitrate;
        $this->queryParameters["VideoBitrate"] = $videoBitrate;
    }

    public function getHeight(){
        return $this->height;
    }

    public function setHeight($height){
        $this->height = $height;
        $this->queryParameters["Height"] = $height;
    }
}