<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class BoardJoinRequest extends RpcAcsRequest {
    private $boardId;
    private $appUid;
    private $ownerId;
    private $appId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "JoinBoard", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getBoardId(){
        return $this->boardId;
    }

    public function setBoardId($boardId){
        $this->boardId = $boardId;
        $this->queryParameters["BoardId"] = $boardId;
    }

    public function getAppUid(){
        return $this->appUid;
    }

    public function setAppUid($appUid){
        $this->appUid = $appUid;
        $this->queryParameters["AppUid"] = $appUid;
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
}