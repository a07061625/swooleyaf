<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PolicyCreateRequest extends RpcAcsRequest {
    private $description;
    private $policyName;
    private $policyDocument;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "CreatePolicy");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
        $this->queryParameters["Description"] = $description;
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