<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.microapp.set_visible_scopes request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class SetVisibleScopesRequest extends BaseRequest
{
    /**
     * 微应用实例化id
     */
    private $agentId;
    /**
     * 设置可见的部门id列表，格式为JSON数组
     */
    private $deptVisibleScopes;
    /**
     * 是否仅限管理员可见，true代表仅限管理员可见
     */
    private $isHidden;
    /**
     * 设置可见的员工id列表，格式为JSON数组
     */
    private $userVisibleScopes;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agentId'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setDeptVisibleScopes($deptVisibleScopes)
    {
        $this->deptVisibleScopes = $deptVisibleScopes;
        $this->apiParas['deptVisibleScopes'] = $deptVisibleScopes;
    }

    public function getDeptVisibleScopes()
    {
        return $this->deptVisibleScopes;
    }

    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;
        $this->apiParas['isHidden'] = $isHidden;
    }

    public function getIsHidden()
    {
        return $this->isHidden;
    }

    public function setUserVisibleScopes($userVisibleScopes)
    {
        $this->userVisibleScopes = $userVisibleScopes;
        $this->apiParas['userVisibleScopes'] = $userVisibleScopes;
    }

    public function getUserVisibleScopes()
    {
        return $this->userVisibleScopes;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.set_visible_scopes';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
