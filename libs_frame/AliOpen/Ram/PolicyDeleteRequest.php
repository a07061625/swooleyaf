<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PolicyDeleteRequest extends RpcAcsRequest {
    private $policyName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "DeletePolicy");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getPolicyName(){
        return $this->policyName;
    }

    public function setPolicyName($policyName){
        $this->policyName = $policyName;
        $this->queryParameters["PolicyName"] = $policyName;
    }
}