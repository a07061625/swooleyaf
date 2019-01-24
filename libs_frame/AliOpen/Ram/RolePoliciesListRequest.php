<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class RolePoliciesListRequest extends RpcAcsRequest {
    private $roleName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "ListPoliciesForRole");
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
}