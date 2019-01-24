<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class GroupUserAddRequest extends RpcAcsRequest {
    private $groupName;
    private $userName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "AddUserToGroup");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getGroupName(){
        return $this->groupName;
    }

    public function setGroupName($groupName){
        $this->groupName = $groupName;
        $this->queryParameters["GroupName"] = $groupName;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
        $this->queryParameters["UserName"] = $userName;
    }
}