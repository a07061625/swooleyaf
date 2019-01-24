<?php
namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

class VoiceIdentityRegisterRequest extends RoaAcsRequest {
    private $clientInfo;

    public function __construct(){
        parent::__construct("Green", "2018-05-09", "VoiceIdentityRegister", "green", "openAPI");
        $this->setUriPattern("/green/voice/auth/register");
        $this->setMethod("POST");
    }

    public function getClientInfo(){
        return $this->clientInfo;
    }

    public function setClientInfo($clientInfo){
        $this->clientInfo = $clientInfo;
        $this->queryParameters["ClientInfo"] = $clientInfo;
    }
}