<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class MFADeviceBindRequest extends RpcAcsRequest {
    private $serialNumber;
    private $authenticationCode2;
    private $authenticationCode1;
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "BindMFADevice");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getSerialNumber(){
        return $this->serialNumber;
    }

    public function setSerialNumber($serialNumber){
        $this->serialNumber = $serialNumber;
        $this->queryParameters["SerialNumber"] = $serialNumber;
    }

    public function getAuthenticationCode2(){
        return $this->authenticationCode2;
    }

    public function setAuthenticationCode2($authenticationCode2){
        $this->authenticationCode2 = $authenticationCode2;
        $this->queryParameters["AuthenticationCode2"] = $authenticationCode2;
    }

    public function getAuthenticationCode1(){
        return $this->authenticationCode1;
    }

    public function setAuthenticationCode1($authenticationCode1){
        $this->authenticationCode1 = $authenticationCode1;
        $this->queryParameters["AuthenticationCode1"] = $authenticationCode1;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }
}