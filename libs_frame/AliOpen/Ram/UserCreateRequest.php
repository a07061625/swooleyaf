<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class UserCreateRequest extends RpcAcsRequest {
    private $comments;
    private $displayName;
    private $mobilePhone;
    private $email;
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "CreateUser");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getComments(){
        return $this->comments;
    }

    public function setComments($comments){
        $this->comments = $comments;
        $this->queryParameters["Comments"] = $comments;
    }

    public function getDisplayName(){
        return $this->displayName;
    }

    public function setDisplayName($displayName){
        $this->displayName = $displayName;
        $this->queryParameters["DisplayName"] = $displayName;
    }

    public function getMobilePhone(){
        return $this->mobilePhone;
    }

    public function setMobilePhone($mobilePhone){
        $this->mobilePhone = $mobilePhone;
        $this->queryParameters["MobilePhone"] = $mobilePhone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
        $this->queryParameters["Email"] = $email;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }
}