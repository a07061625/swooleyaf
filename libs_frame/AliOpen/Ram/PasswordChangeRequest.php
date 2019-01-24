<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PasswordChangeRequest extends RpcAcsRequest {
    private $oldPassword;
    private $newPassword;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "ChangePassword");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getOldPassword(){
        return $this->oldPassword;
    }

    public function setOldPassword($oldPassword){
        $this->oldPassword = $oldPassword;
        $this->queryParameters["OldPassword"] = $oldPassword;
    }

    public function getNewPassword(){
        return $this->newPassword;
    }

    public function setNewPassword($newPassword){
        $this->newPassword = $newPassword;
        $this->queryParameters["NewPassword"] = $newPassword;
    }
}