<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class RoleUpdateRequest extends RpcAcsRequest {
    private $newAssumeRolePolicyDocument;
    private $roleName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "UpdateRole");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getNewAssumeRolePolicyDocument(){
        return $this->newAssumeRolePolicyDocument;
    }

    public function setNewAssumeRolePolicyDocument($newAssumeRolePolicyDocument){
        $this->newAssumeRolePolicyDocument = $newAssumeRolePolicyDocument;
        $this->queryParameters["NewAssumeRolePolicyDocument"] = $newAssumeRolePolicyDocument;
    }

    public function getRoleName(){
        return $this->roleName;
    }

    public function setRoleName($roleName){
        $this->roleName = $roleName;
        $this->queryParameters["RoleName"] = $roleName;
    }
}