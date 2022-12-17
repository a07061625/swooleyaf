<?php

namespace SyDingTalk\Oapi\Authorization;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.authorization.rbac.role.member.remove request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.20
 */
class RbacRoleMemberRemoveRequest extends BaseRequest
{
    /**
     * 微应用agenId,需要联系权限平台配置
     */
    private $agentId;
    /**
     * 管理组id
     */
    private $openRoleId;
    /**
     * 被删除的成员类表
     */
    private $removeMembers;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setOpenRoleId($openRoleId)
    {
        $this->openRoleId = $openRoleId;
        $this->apiParas['open_role_id'] = $openRoleId;
    }

    public function getOpenRoleId()
    {
        return $this->openRoleId;
    }

    public function setRemoveMembers($removeMembers)
    {
        $this->removeMembers = $removeMembers;
        $this->apiParas['remove_members'] = $removeMembers;
    }

    public function getRemoveMembers()
    {
        return $this->removeMembers;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.authorization.rbac.role.member.remove';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->openRoleId, 'openRoleId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
