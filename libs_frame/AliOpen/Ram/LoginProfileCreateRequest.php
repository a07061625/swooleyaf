<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class LoginProfileCreateRequest extends RpcAcsRequest {
    private $password;
    private $passwordResetRequired;
    private $mFABindRequired;
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "CreateLoginProfile");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
        $this->queryParameters["Password"] = $password;
    }

    public function getPasswordResetRequired(){
        return $this->passwordResetRequired;
    }

    public function setPasswordResetRequired($passwordResetRequired){
        $this->passwordResetRequired = $passwordResetRequired;
        $this->queryParameters["PasswordResetRequired"] = $passwordResetRequired;
    }

    public function getMFABindRequired(){
        return $this->mFABindRequired;
    }

    public function setMFABindRequired($mFABindRequired){
        $this->mFABindRequired = $mFABindRequired;
        $this->queryParameters["MFABindRequired"] = $mFABindRequired;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }
}