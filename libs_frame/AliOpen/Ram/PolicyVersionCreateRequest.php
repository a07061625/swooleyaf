<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PolicyVersionCreateRequest extends RpcAcsRequest {
    private $setAsDefault;
    private $policyName;
    private $policyDocument;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "CreatePolicyVersion");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getSetAsDefault(){
        return $this->setAsDefault;
    }

    public function setSetAsDefault($setAsDefault){
        $this->setAsDefault = $setAsDefault;
        $this->queryParameters["SetAsDefault"] = $setAsDefault;
    }

    public function getPolicyName(){
        return $this->policyName;
    }

    public function setPolicyName($policyName){
        $this->policyName = $policyName;
        $this->queryParameters["PolicyName"] = $policyName;
    }

    public function getPolicyDocument(){
        return $this->policyDocument;
    }

    public function setPolicyDocument($policyDocument){
        $this->policyDocument = $policyDocument;
        $this->queryParameters["PolicyDocument"] = $policyDocument;
    }
}