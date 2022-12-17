<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.scope.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.11.13
 */
class ScopeUpdateRequest extends BaseRequest
{
    /**
     * 部门ID列表数
     */
    private $deptIds;
    /**
     * 角色ID
     */
    private $roleId;
    /**
     * 员工在企业中的ID
     */
    private $userid;

    public function setDeptIds($deptIds)
    {
        $this->deptIds = $deptIds;
        $this->apiParas['dept_ids'] = $deptIds;
    }

    public function getDeptIds()
    {
        return $this->deptIds;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        $this->apiParas['role_id'] = $roleId;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.role.scope.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->deptIds, 200, 'deptIds');
        RequestCheckUtil::checkNotNull($this->roleId, 'roleId');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
