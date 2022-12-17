<?php

namespace SyDingTalk\Oapi\Authorization;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.authorization.rbac.role.resource.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.20
 */
class RbacRoleResourceUpdateRequest extends BaseRequest
{
    /**
     * 微应用agenId,需要联系权限平台配置
     */
    private $agentId;
    /**
     * 授权的资源列表
     */
    private $openResources;
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

    public function setOpenResources($openResources)
    {
        $this->openResources = $openResources;
        $this->apiParas['open_resources'] = $openResources;
    }

    public function getOpenResources()
    {
        return $this->openResources;
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
        return 'dingtalk.oapi.authorization.rbac.role.resource.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->openResources, 'openResources');
        RequestCheckUtil::checkMaxListSize($this->openResources, 999, 'openResources');
        RequestCheckUtil::checkNotNull($this->openRoleId, 'openRoleId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
