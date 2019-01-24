<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class InputBucketBindRequest extends RpcAcsRequest {
    private $bucket;
    private $resourceOwnerId;
    private $resourceOwnerAccount;
    private $roleArn;
    private $ownerAccount;
    private $ownerId;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "BindInputBucket", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getBucket(){
        return $this->bucket;
    }

    public function setBucket($bucket){
        $this->bucket = $bucket;
        $this->queryParameters["Bucket"] = $bucket;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getRoleArn(){
        return $this->roleArn;
    }

    public function setRoleArn($roleArn){
        $this->roleArn = $roleArn;
        $this->queryParameters["RoleArn"] = $roleArn;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}