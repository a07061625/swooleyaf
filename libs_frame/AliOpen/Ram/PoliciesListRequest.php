<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PoliciesListRequest extends RpcAcsRequest {
    private $policyType;
    private $marker;
    private $maxItems;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "ListPolicies");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getPolicyType(){
        return $this->policyType;
    }

    public function setPolicyType($policyType){
        $this->policyType = $policyType;
        $this->queryParameters["PolicyType"] = $policyType;
    }

    public function getMarker(){
        return $this->marker;
    }

    public function setMarker($marker){
        $this->marker = $marker;
        $this->queryParameters["Marker"] = $marker;
    }

    public function getMaxItems(){
        return $this->maxItems;
    }

    public function setMaxItems($maxItems){
        $this->maxItems = $maxItems;
        $this->queryParameters["MaxItems"] = $maxItems;
    }
}