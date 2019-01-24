<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class QueryDevicesByAccountRequest extends RpcAcsRequest {
    private $appKey;
    private $account;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "QueryDevicesByAccount");
        $this->setMethod("POST");
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }

    public function getAccount(){
        return $this->account;
    }

    public function setAccount($account){
        $this->account = $account;
        $this->queryParameters["Account"] = $account;
    }
}