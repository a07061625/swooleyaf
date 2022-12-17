<?php

namespace SyDingTalk\Oapi\Authorization;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.authorization.rbac.role.action.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.20
 */
class RbacRoleActionUpdateRequest extends BaseRequest
{
    /**
     * 微应用agenId,需要联系权限平台配置
     */
    private $agentId;
    /**
     * action
     */
    private $openAction;
    /**
     * 管理组id
     */
    private $openRoleId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setOpenAction($openAction)
    {
        $this->openAction = $openAction;
        $this->apiParas['open_action'] = $openAction;
    }

    public function getOpenAction()
    {
        return $this->openAction;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.authorization.rbac.role.action.update';
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
