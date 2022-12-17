<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.update_role request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.12
 */
class UpdateRoleRequest extends BaseRequest
{
    /**
     * 角色id
     */
    private $roleId;
    /**
     * 角色名称
     */
    private $roleName;

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        $this->apiParas['roleId'] = $roleId;
    }

    public function getRoleId()
    {
        return $this->roleId;
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
        return 'dingtalk.oapi.role.update_role';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->roleId, 'roleId');
        RequestCheckUtil::checkNotNull($this->roleName, 'roleName');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
