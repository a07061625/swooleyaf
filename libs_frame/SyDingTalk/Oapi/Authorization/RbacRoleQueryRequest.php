<?php

namespace SyDingTalk\Oapi\Authorization;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.authorization.rbac.role.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.01
 */
class RbacRoleQueryRequest extends BaseRequest
{
    /**
     * 微应用agenId,需要联系权限平台配置
     */
    private $agentId;
    /**
     * 管理组id
     */
    private $openRoleIds;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setOpenRoleIds($openRoleIds)
    {
        $this->openRoleIds = $openRoleIds;
        $this->apiParas['open_role_ids'] = $openRoleIds;
    }

    public function getOpenRoleIds()
    {
        return $this->openRoleIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.authorization.rbac.role.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->openRoleIds, 'openRoleIds');
        RequestCheckUtil::checkMaxListSize($this->openRoleIds, 999, 'openRoleIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
