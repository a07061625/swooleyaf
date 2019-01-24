<?php
namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

class ImageAsyncScanResultsRequest extends RoaAcsRequest {
    private $clientInfo;

    public function __construct(){
        parent::__construct("Green", "2018-05-09", "ImageAsyncScanResults", "green", "openAPI");
        $this->setUriPattern("/green/image/results");
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