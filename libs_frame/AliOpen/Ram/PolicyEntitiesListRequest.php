<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PolicyEntitiesListRequest extends RpcAcsRequest {
    private $policyType;
    private $policyName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "ListEntitiesForPolicy");
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

    public function getPolicyName(){
        return $this->policyName;
    }

    public function setPolicyName($policyName){
        $this->policyName = $policyName;
        $this->queryParameters["PolicyName"] = $policyName;
    }
}