<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterEpisodeGroupContentAddRequest extends RpcAcsRequest {
    private $clientToken;
    private $ownerId;
    private $content;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "AddCasterEpisodeGroupContent", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getClientToken(){
        return $this->clientToken;
    }

    public function setClientToken($clientToken){
        $this->clientToken = $clientToken;
        $this->queryParameters["ClientToken"] = $clientToken;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
        $this->queryParameters["Content"] = $content;
    }
}