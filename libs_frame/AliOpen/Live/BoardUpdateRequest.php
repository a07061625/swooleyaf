<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class BoardUpdateRequest extends RpcAcsRequest {
    private $ownerId;
    private $appId;
    private $boardData;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "UpdateBoard", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getAppId(){
        return $this->appId;
    }

    public function setAppId($appId){
        $this->appId = $appId;
        $this->queryParameters["AppId"] = $appId;
    }

    public function getBoardData(){
        return $this->boardData;
    }

    public function setBoardData($boardData){
        $this->boardData = $boardData;
        $this->queryParameters["BoardData"] = $boardData;
    }
}