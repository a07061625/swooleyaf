<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterStopRequest extends RpcAcsRequest {
    private $casterId;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "StopCaster", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}