<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterComponentsDescribeRequest extends RpcAcsRequest {
    private $componentId;
    private $casterId;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DescribeCasterComponents", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getComponentId(){
        return $this->componentId;
    }

    public function setComponentId($componentId){
        $this->componentId = $componentId;
        $this->queryParameters["ComponentId"] = $componentId;
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