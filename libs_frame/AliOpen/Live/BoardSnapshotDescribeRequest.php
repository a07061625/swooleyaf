<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class BoardSnapshotDescribeRequest extends RpcAcsRequest {
    private $ownerId;
    private $appId;
    private $boardId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeBoardSnapshot", "live", "openAPI");
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

    public function getBoardId(){
        return $this->boardId;
    }

    public function setBoardId($boardId){
        $this->boardId = $boardId;
        $this->queryParameters["BoardId"] = $boardId;
    }
}