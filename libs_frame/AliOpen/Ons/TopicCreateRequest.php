<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

class TopicCreateRequest extends RpcAcsRequest {
    private $preventCache;
    private $cluster;
    private $queueNum;
    private $onsRegionId;
    private $onsPlatform;
    private $appName;
    private $qps;
    private $topic;
    private $remark;
    private $appkey;
    private $order;
    private $status;

    public function __construct(){
        parent::__construct("Ons", "2017-09-18", "OnsTopicCreate");
        $this->setMethod("POST");
    }

    public function getPreventCache(){
        return $this->preventCache;
    }

    public function setPreventCache($preventCache){
        $this->preventCache = $preventCache;
        $this->queryParameters["PreventCache"] = $preventCache;
    }

    public function getCluster(){
        return $this->cluster;
    }

    public function setCluster($cluster){
        $this->cluster = $cluster;
        $this->queryParameters["Cluster"] = $cluster;
    }

    public function getQueueNum(){
        return $this->queueNum;
    }

    public function setQueueNum($queueNum){
        $this->queueNum = $queueNum;
        $this->queryParameters["QueueNum"] = $queueNum;
    }

    public function getOnsRegionId(){
        return $this->onsRegionId;
    }

    public function setOnsRegionId($onsRegionId){
        $this->onsRegionId = $onsRegionId;
        $this->queryParameters["OnsRegionId"] = $onsRegionId;
    }

    public function getOnsPlatform(){
        return $this->onsPlatform;
    }

    public function setOnsPlatform($onsPlatform){
        $this->onsPlatform = $onsPlatform;
        $this->queryParameters["OnsPlatform"] = $onsPlatform;
    }

    public function getAppName(){
        return $this->appName;
    }

    public function setAppName($appName){
        $this->appName = $appName;
        $this->queryParameters["AppName"] = $appName;
    }

    public function getQps(){
        return $this->qps;
    }

    public function setQps($qps){
        $this->qps = $qps;
        $this->queryParameters["Qps"] = $qps;
    }

    public function getTopic(){
        return $this->topic;
    }

    public function setTopic($topic){
        $this->topic = $topic;
        $this->queryParameters["Topic"] = $topic;
    }

    public function getRemark(){
        return $this->remark;
    }

    public function setRemark($remark){
        $this->remark = $remark;
        $this->queryParameters["Remark"] = $remark;
    }

    public function getAppkey(){
        return $this->appkey;
    }

    public function setAppkey($appkey){
        $this->appkey = $appkey;
        $this->queryParameters["Appkey"] = $appkey;
    }

    public function getOrder(){
        return $this->order;
    }

    public function setOrder($order){
        $this->order = $order;
        $this->queryParameters["Order"] = $order;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
        $this->queryParameters["Status"] = $status;
    }
}