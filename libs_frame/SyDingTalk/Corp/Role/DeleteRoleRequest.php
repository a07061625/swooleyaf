<?php

namespace SyDingTalk\Corp\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.role.deleterole request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class DeleteRoleRequest extends BaseRequest
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
        return 'dingtalk.corp.role.deleterole';
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
