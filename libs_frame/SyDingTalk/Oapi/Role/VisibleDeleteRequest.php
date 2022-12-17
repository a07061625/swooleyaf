<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.visible.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2019.09.16
 */
class VisibleDeleteRequest extends BaseRequest
{
    /**
     * 角色ID
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
        return 'dingtalk.oapi.role.visible.delete';
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
