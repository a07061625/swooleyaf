<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.removerolesforemps request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class RemoveRolesForEmpsRequest extends BaseRequest
{
    /**
     * 角色标签id
     */
    private $roleIds;
    /**
     * 用户userId
     */
    private $userIds;

    public function setRoleIds($roleIds)
    {
        $this->roleIds = $roleIds;
        $this->apiParas['roleIds'] = $roleIds;
    }

    public function getRoleIds()
    {
        return $this->roleIds;
    }

    public function setUserIds($userIds)
    {
        $this->userIds = $userIds;
        $this->apiParas['userIds'] = $userIds;
    }

    public function getUserIds()
    {
        return $this->userIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.role.removerolesforemps';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->roleIds, 'roleIds');
        RequestCheckUtil::checkMaxListSize($this->roleIds, 20, 'roleIds');
        RequestCheckUtil::checkNotNull($this->userIds, 'userIds');
        RequestCheckUtil::checkMaxListSize($this->userIds, 100, 'userIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
