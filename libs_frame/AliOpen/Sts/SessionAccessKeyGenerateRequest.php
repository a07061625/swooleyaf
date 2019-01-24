<?php
namespace AliOpen\Sts;

use AliOpen\Core\RpcAcsRequest;

class SessionAccessKeyGenerateRequest extends RpcAcsRequest {
    private $durationSeconds;

    public function __construct(){
        parent::__construct("Sts", "2015-04-01", "GenerateSessionAccessKey");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getDurationSeconds(){
        return $this->durationSeconds;
    }

    public function setDurationSeconds($durationSeconds){
        $this->durationSeconds = $durationSeconds;
        $this->queryParameters["DurationSeconds"] = $durationSeconds;
    }
}