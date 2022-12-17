<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.getrole request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetRoleRequest extends BaseRequest
{
    /**
     * 角色id
     */
    private $roleId;

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        $this->apiParas['roleId'] = $roleId;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.role.getrole';
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
