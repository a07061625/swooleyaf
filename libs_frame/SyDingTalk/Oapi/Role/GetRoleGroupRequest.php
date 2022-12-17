<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.getrolegroup request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetRoleGroupRequest extends BaseRequest
{
    /**
     * 角色组的Id
     */
    private $groupId;

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        $this->apiParas['group_id'] = $groupId;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.role.getrolegroup';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->groupId, 'groupId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
