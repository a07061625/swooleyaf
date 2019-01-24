<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class RoleCreateRequest extends RpcAcsRequest {
    private $roleName;
    private $description;
    private $assumeRolePolicyDocument;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "CreateRole");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getRoleName(){
        return $this->roleName;
    }

    public function setRoleName($roleName){
        $this->roleName = $roleName;
        $this->queryParameters["RoleName"] = $roleName;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
        $this->queryParameters["Description"] = $description;
    }

    public function getAssumeRolePolicyDocument(){
        return $this->assumeRolePolicyDocument;
    }

    public function setAssumeRolePolicyDocument($assumeRolePolicyDocument){
        $this->assumeRolePolicyDocument = $assumeRolePolicyDocument;
        $this->queryParameters["AssumeRolePolicyDocument"] = $assumeRolePolicyDocument;
    }
}