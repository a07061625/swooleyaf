<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class GroupUsersListRequest extends RpcAcsRequest {
    private $groupName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "ListUsersForGroup");
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
}