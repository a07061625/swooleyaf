<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class GroupUpdateRequest extends RpcAcsRequest {
    private $newGroupName;
    private $newComments;
    private $groupName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "UpdateGroup");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getNewGroupName(){
        return $this->newGroupName;
    }

    public function setNewGroupName($newGroupName){
        $this->newGroupName = $newGroupName;
        $this->queryParameters["NewGroupName"] = $newGroupName;
    }

    public function getNewComments(){
        return $this->newComments;
    }

    public function setNewComments($newComments){
        $this->newComments = $newComments;
        $this->queryParameters["NewComments"] = $newComments;
    }

    public function getGroupName(){
        return $this->groupName;
    }

    public function setGroupName($groupName){
        $this->groupName = $groupName;
        $this->queryParameters["GroupName"] = $groupName;
    }
}