<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class LoginProfileGetRequest extends RpcAcsRequest {
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "GetLoginProfile");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }
}