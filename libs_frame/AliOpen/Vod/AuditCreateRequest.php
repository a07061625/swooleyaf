<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

class AuditCreateRequest extends RpcAcsRequest {
    private $auditContent;

    public function __construct(){
        parent::__construct("vod", "2017-03-21", "CreateAudit", "vod", "openAPI");
        $this->setMethod("POST");
    }

    public function getAuditContent(){
        return $this->auditContent;
    }

    public function setAuditContent($auditContent){
        $this->auditContent = $auditContent;
        $this->queryParameters["AuditContent"] = $auditContent;
    }
}