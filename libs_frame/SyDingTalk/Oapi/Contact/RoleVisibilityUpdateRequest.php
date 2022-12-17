<?php

namespace SyDingTalk\Oapi\Contact;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.contact.rolevisibility.update request
 *
 * @author auto create
 *
 * @since 1.0, 2022.02.17
 */
class RoleVisibilityUpdateRequest extends BaseRequest
{
    /**
     * 权限设置列表
     */
    private $permissions;
    /**
     * 角色id
     */
    private $roleId;

    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
        $this->apiParas['permissions'] = $permissions;
    }

    public function getPermissions()
    {
        return $this->permissions;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.contact.rolevisibility.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->roleId, 'roleId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
