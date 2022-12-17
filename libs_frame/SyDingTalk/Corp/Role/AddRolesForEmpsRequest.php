<?php

namespace SyDingTalk\Corp\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.role.addrolesforemps request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class AddRolesForEmpsRequest extends BaseRequest
{
    /**
     * 角色id list
     */
    private $rolelidList;
    /**
     * 员工id list
     */
    private $useridList;

    public function setRolelidList($rolelidList)
    {
        $this->rolelidList = $rolelidList;
        $this->apiParas['rolelid_list'] = $rolelidList;
    }

    public function getRolelidList()
    {
        return $this->rolelidList;
    }

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.role.addrolesforemps';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->rolelidList, 'rolelidList');
        RequestCheckUtil::checkMaxListSize($this->rolelidList, 20, 'rolelidList');
        RequestCheckUtil::checkNotNull($this->useridList, 'useridList');
        RequestCheckUtil::checkMaxListSize($this->useridList, 100, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
