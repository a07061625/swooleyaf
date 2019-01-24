<?php
namespace AliOpen\Sts;

use AliOpen\Core\RpcAcsRequest;

class CallerIdentityGetRequest extends RpcAcsRequest {
    public function __construct(){
        parent::__construct("Sts", "2015-04-01", "GetCallerIdentity");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }
}