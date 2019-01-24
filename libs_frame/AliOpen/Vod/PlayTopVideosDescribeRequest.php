<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class PlayTopVideosDescribeRequest extends RpcAcsRequest {
    private $bizDate;
    private $pageNo;
    private $pageSize;
    private $ownerId;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "DescribePlayTopVideos", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getBizDate(){
        return $this->bizDate;
    }

    public function setBizDate($bizDate){
        $this->bizDate = $bizDate;
        $this->queryParameters["BizDate"] = $bizDate;
    }

    public function getPageNo(){
        return $this->pageNo;
    }

    public function setPageNo($pageNo){
        $this->pageNo = $pageNo;
        $this->queryParameters["PageNo"] = $pageNo;
    }

    public function getPageSize(){
        return $this->pageSize;
    }

    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
        $this->queryParameters["PageSize"] = $pageSize;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}