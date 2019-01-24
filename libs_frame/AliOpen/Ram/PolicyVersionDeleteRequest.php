<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PolicyVersionDeleteRequest extends RpcAcsRequest {
    private $versionId;
    private $policyName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "DeletePolicyVersion");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getVersionId(){
        return $this->versionId;
    }

    public function setVersionId($versionId){
        $this->versionId = $versionId;
        $this->queryParameters["VersionId"] = $versionId;
    }

    public function getPolicyName(){
        return $this->policyName;
    }

    public function setPolicyName($policyName){
        $this->policyName = $policyName;
        $this->queryParameters["PolicyName"] = $policyName;
    }
}