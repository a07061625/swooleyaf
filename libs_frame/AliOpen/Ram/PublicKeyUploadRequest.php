<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PublicKeyUploadRequest extends RpcAcsRequest {
    private $publicKeySpec;
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "UploadPublicKey");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getPublicKeySpec(){
        return $this->publicKeySpec;
    }

    public function setPublicKeySpec($publicKeySpec){
        $this->publicKeySpec = $publicKeySpec;
        $this->queryParameters["PublicKeySpec"] = $publicKeySpec;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }
}