<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class AccountAliasGetRequest extends RpcAcsRequest {
    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "GetAccountAlias");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }
}