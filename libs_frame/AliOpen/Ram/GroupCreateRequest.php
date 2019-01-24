<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class GroupCreateRequest extends RpcAcsRequest {
    private $comments;
    private $groupName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "CreateGroup");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getComments(){
        return $this->comments;
    }

    public function setComments($comments){
        $this->comments = $comments;
        $this->queryParameters["Comments"] = $comments;
    }

    public function getGroupName(){
        return $this->groupName;
    }

    public function setGroupName($groupName){
        $this->groupName = $groupName;
        $this->queryParameters["GroupName"] = $groupName;
    }
}