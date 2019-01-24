<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

class ListSummaryAppsRequest extends RpcAcsRequest {
    public function __construct(){
        parent::__construct("Push", "2016-08-01", "ListSummaryApps");
        $this->setMethod("POST");
    }
}