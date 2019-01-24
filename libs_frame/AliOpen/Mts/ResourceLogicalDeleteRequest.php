<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class ResourceLogicalDeleteRequest extends RpcAcsRequest {
    private $country;
    private $hid;
    private $success;
    private $interrupt;
    private $gmtWakeup;
    private $pk;
    private $invoker;
    private $bid;
    private $message;
    private $taskExtraData;
    private $taskIdentifier;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "LogicalDeleteResource", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getCountry(){
        return $this->country;
    }

    public function setCountry($country){
        $this->country = $country;
        $this->queryParameters["Country"] = $country;
    }

    public function getHid(){
        return $this->hid;
    }

    public function setHid($hid){
        $this->hid = $hid;
        $this->queryParameters["Hid"] = $hid;
    }

    public function getSuccess(){
        return $this->success;
    }

    public function setSuccess($success){
        $this->success = $success;
        $this->queryParameters["Success"] = $success;
    }

    public function getInterrupt(){
        return $this->interrupt;
    }

    public function setInterrupt($interrupt){
        $this->interrupt = $interrupt;
        $this->queryParameters["Interrupt"] = $interrupt;
    }

    public function getGmtWakeup(){
        return $this->gmtWakeup;
    }

    public function setGmtWakeup($gmtWakeup){
        $this->gmtWakeup = $gmtWakeup;
        $this->queryParameters["GmtWakeup"] = $gmtWakeup;
    }

    public function getPk(){
        return $this->pk;
    }

    public function setPk($pk){
        $this->pk = $pk;
        $this->queryParameters["Pk"] = $pk;
    }

    public function getInvoker(){
        return $this->invoker;
    }

    public function setInvoker($invoker){
        $this->invoker = $invoker;
        $this->queryParameters["Invoker"] = $invoker;
    }

    public function getBid(){
        return $this->bid;
    }

    public function setBid($bid){
        $this->bid = $bid;
        $this->queryParameters["Bid"] = $bid;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage($message){
        $this->message = $message;
        $this->queryParameters["Message"] = $message;
    }

    public function getTaskExtraData(){
        return $this->taskExtraData;
    }

    public function setTaskExtraData($taskExtraData){
        $this->taskExtraData = $taskExtraData;
        $this->queryParameters["TaskExtraData"] = $taskExtraData;
    }

    public function getTaskIdentifier(){
        return $this->taskIdentifier;
    }

    public function setTaskIdentifier($taskIdentifier){
        $this->taskIdentifier = $taskIdentifier;
        $this->queryParameters["TaskIdentifier"] = $taskIdentifier;
    }
}