<?php
namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

class TextScanRequest extends RoaAcsRequest {
    private $clientInfo;

    public function __construct(){
        parent::__construct("Green", "2018-05-09", "TextScan", "green", "openAPI");
        $this->setUriPattern("/green/text/scan");
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