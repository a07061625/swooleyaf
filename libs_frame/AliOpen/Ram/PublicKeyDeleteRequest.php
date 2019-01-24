<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PublicKeyDeleteRequest extends RpcAcsRequest {
    private $userPublicKeyId;
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "DeletePublicKey");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getUserPublicKeyId(){
        return $this->userPublicKeyId;
    }

    public function setUserPublicKeyId($userPublicKeyId){
        $this->userPublicKeyId = $userPublicKeyId;
        $this->queryParameters["UserPublicKeyId"] = $userPublicKeyId;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }
}