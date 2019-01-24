<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class UserUpdateRequest extends RpcAcsRequest {
    private $newUserName;
    private $newDisplayName;
    private $newMobilePhone;
    private $newComments;
    private $newEmail;
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "UpdateUser");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getNewUserName(){
        return $this->newUserName;
    }

    public function setNewUserName($newUserName){
        $this->newUserName = $newUserName;
        $this->queryParameters["NewUserName"] = $newUserName;
    }

    public function getNewDisplayName(){
        return $this->newDisplayName;
    }

    public function setNewDisplayName($newDisplayName){
        $this->newDisplayName = $newDisplayName;
        $this->queryParameters["NewDisplayName"] = $newDisplayName;
    }

    public function getNewMobilePhone(){
        return $this->newMobilePhone;
    }

    public function setNewMobilePhone($newMobilePhone){
        $this->newMobilePhone = $newMobilePhone;
        $this->queryParameters["NewMobilePhone"] = $newMobilePhone;
    }

    public function getNewComments(){
        return $this->newComments;
    }

    public function setNewComments($newComments){
        $this->newComments = $newComments;
        $this->queryParameters["NewComments"] = $newComments;
    }

    public function getNewEmail(){
        return $this->newEmail;
    }

    public function setNewEmail($newEmail){
        $this->newEmail = $newEmail;
        $this->queryParameters["NewEmail"] = $newEmail;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }
}