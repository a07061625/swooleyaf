<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PublicKeyUpdateRequest extends RpcAcsRequest {
    private $userPublicKeyId;
    private $userName;
    private $status;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "UpdatePublicKey");
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

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
        $this->queryParameters["Status"] = $status;
    }
}