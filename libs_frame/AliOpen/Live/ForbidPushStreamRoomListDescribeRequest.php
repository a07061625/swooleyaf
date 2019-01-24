<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class ForbidPushStreamRoomListDescribeRequest extends RpcAcsRequest {
    private $pageNum;
    private $pageSize;
    private $order;
    private $ownerId;
    private $appId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeForbidPushStreamRoomList", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getPageNum(){
        return $this->pageNum;
    }

    public function setPageNum($pageNum){
        $this->pageNum = $pageNum;
        $this->queryParameters["PageNum"] = $pageNum;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getOrder(){
        return $this->order;
    }

    public function setOrder($order){
        $this->order = $order;
        $this->queryParameters["Order"] = $order;
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