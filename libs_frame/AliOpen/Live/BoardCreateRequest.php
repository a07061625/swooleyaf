<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class BoardCreateRequest extends RpcAcsRequest {
    private $appUid;
    private $ownerId;
    private $appId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "CreateBoard", "live", "openAPI");
        $this->setMethod("POST");
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