<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class SecurityPreferenceSetRequest extends RpcAcsRequest {
    private $allowUserToManageAccessKeys;
    private $allowUserToManageMFADevices;
    private $allowUserToManagePublicKeys;
    private $enableSaveMFATicket;
    private $allowUserToChangePassword;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "SetSecurityPreference");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getAllowUserToManageAccessKeys(){
        return $this->allowUserToManageAccessKeys;
    }

    public function setAllowUserToManageAccessKeys($allowUserToManageAccessKeys){
        $this->allowUserToManageAccessKeys = $allowUserToManageAccessKeys;
        $this->queryParameters["AllowUserToManageAccessKeys"] = $allowUserToManageAccessKeys;
    }

    public function getAllowUserToManageMFADevices(){
        return $this->allowUserToManageMFADevices;
    }

    public function setAllowUserToManageMFADevices($allowUserToManageMFADevices){
        $this->allowUserToManageMFADevices = $allowUserToManageMFADevices;
        $this->queryParameters["AllowUserToManageMFADevices"] = $allowUserToManageMFADevices;
    }

    public function getAllowUserToManagePublicKeys(){
        return $this->allowUserToManagePublicKeys;
    }

    public function setAllowUserToManagePublicKeys($allowUserToManagePublicKeys){
        $this->allowUserToManagePublicKeys = $allowUserToManagePublicKeys;
        $this->queryParameters["AllowUserToManagePublicKeys"] = $allowUserToManagePublicKeys;
    }

    public function getEnableSaveMFATicket(){
        return $this->enableSaveMFATicket;
    }

    public function setEnableSaveMFATicket($enableSaveMFATicket){
        $this->enableSaveMFATicket = $enableSaveMFATicket;
        $this->queryParameters["EnableSaveMFATicket"] = $enableSaveMFATicket;
    }

    public function getAllowUserToChangePassword(){
        return $this->allowUserToChangePassword;
    }

    public function setAllowUserToChangePassword($allowUserToChangePassword){
        $this->allowUserToChangePassword = $allowUserToChangePassword;
        $this->queryParameters["AllowUserToChangePassword"] = $allowUserToChangePassword;
    }
}