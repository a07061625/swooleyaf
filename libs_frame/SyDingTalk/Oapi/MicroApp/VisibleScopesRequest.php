<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.microapp.visible_scopes request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class VisibleScopesRequest extends BaseRequest
{
    /**
     * 微应用实例化id
     */
    private $agentId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agentId'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.visible_scopes';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
