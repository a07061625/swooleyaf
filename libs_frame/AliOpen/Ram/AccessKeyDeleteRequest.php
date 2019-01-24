<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class AccessKeyDeleteRequest extends RpcAcsRequest {
    private $userAccessKeyId;
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "DeleteAccessKey");
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
}