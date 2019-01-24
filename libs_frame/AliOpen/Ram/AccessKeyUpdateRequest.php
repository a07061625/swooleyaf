<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class AccessKeyUpdateRequest extends RpcAcsRequest {
    private $userAccessKeyId;
    private $userName;
    private $status;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "UpdateAccessKey");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getUserAccessKeyId(){
        return $this->userAccessKeyId;
    }

    public function setUserAccessKeyId($userAccessKeyId){
        $this->userAccessKeyId = $userAccessKeyId;
        $this->queryParameters["UserAccessKeyId"] = $userAccessKeyId;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
        $this->queryParameters["Status"] = $status;
    }
}