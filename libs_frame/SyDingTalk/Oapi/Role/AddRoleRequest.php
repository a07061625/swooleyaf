<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.add_role request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.12
 */
class AddRoleRequest extends BaseRequest
{
    /**
     * 角色组id
     */
    private $groupId;
    /**
     * 角色名称
     */
    private $roleName;

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        $this->apiParas['groupId'] = $groupId;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
        $this->apiParas['roleName'] = $roleName;
    }

    public function getRoleName()
    {
        return $this->roleName;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.role.add_role';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->groupId, 'groupId');
        RequestCheckUtil::checkNotNull($this->roleName, 'roleName');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
