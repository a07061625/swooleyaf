<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class AccountAliasSetRequest extends RpcAcsRequest {
    private $accountAlias;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "SetAccountAlias");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getAccountAlias(){
        return $this->accountAlias;
    }

    public function setAccountAlias($accountAlias){
        $this->accountAlias = $accountAlias;
        $this->queryParameters["AccountAlias"] = $accountAlias;
    }
}