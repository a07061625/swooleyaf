<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class AuditHistoryGetRequest extends RpcAcsRequest {
    private $pageNo;
    private $pageSize;
    private $videoId;
    private $sortBy;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "GetAuditHistory", "vod", "openAPI");
        $this->setMethod("POST");
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

    public function getVideoId(){
        return $this->videoId;
    }

    public function setVideoId($videoId){
        $this->videoId = $videoId;
        $this->queryParameters["VideoId"] = $videoId;
    }

    public function getSortBy(){
        return $this->sortBy;
    }

    public function setSortBy($sortBy){
        $this->sortBy = $sortBy;
        $this->queryParameters["SortBy"] = $sortBy;
    }
}