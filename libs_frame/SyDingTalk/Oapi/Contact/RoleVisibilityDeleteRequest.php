<?php

namespace SyDingTalk\Oapi\Contact;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.contact.rolevisibility.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2021.12.06
 */
class RoleVisibilityDeleteRequest extends BaseRequest
{
    /**
     * 角色id
     */
    private $roleId;

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
        return 'dingtalk.oapi.contact.rolevisibility.delete';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
