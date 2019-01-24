<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class QueryDevicesByAliasRequest extends RpcAcsRequest {
    private $alias;
    private $appKey;

    public function __construct(){
        parent::__construct("Push", "2016-08-01", "QueryDevicesByAlias");
        $this->setMethod("POST");
    }

    public function getAlias(){
        return $this->alias;
    }

    public function setAlias($alias){
        $this->alias = $alias;
        $this->queryParameters["Alias"] = $alias;
    }

    public function getAppKey(){
        return $this->appKey;
    }

    public function setAppKey($appKey){
        $this->appKey = $appKey;
        $this->queryParameters["AppKey"] = $appKey;
    }
}