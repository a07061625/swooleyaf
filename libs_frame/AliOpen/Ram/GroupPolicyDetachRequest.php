<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class GroupPolicyDetachRequest extends RpcAcsRequest {
    private $policyType;
    private $policyName;
    private $groupName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "DetachPolicyFromGroup");
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

    public function getGroupName(){
        return $this->groupName;
    }

    public function setGroupName($groupName){
        $this->groupName = $groupName;
        $this->queryParameters["GroupName"] = $groupName;
    }
}