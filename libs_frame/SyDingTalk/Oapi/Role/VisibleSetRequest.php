<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.visible.set request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.18
 */
class VisibleSetRequest extends BaseRequest
{
    /**
     * roleId
     */
    private $roleId;
    /**
     * roleId可见的roleIdList
     */
    private $visibleRoleIds;

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        $this->apiParas['role_id'] = $roleId;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setVisibleRoleIds($visibleRoleIds)
    {
        $this->visibleRoleIds = $visibleRoleIds;
        $this->apiParas['visible_role_ids'] = $visibleRoleIds;
    }

    public function getVisibleRoleIds()
    {
        return $this->visibleRoleIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.role.visible.set';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->roleId, 'roleId');
        RequestCheckUtil::checkNotNull($this->visibleRoleIds, 'visibleRoleIds');
        RequestCheckUtil::checkMaxListSize($this->visibleRoleIds, 50, 'visibleRoleIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
