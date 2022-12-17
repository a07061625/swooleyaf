<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.microapp.rule.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class RuleDeleteRequest extends BaseRequest
{
    /**
     * 规则所属的微应用agentId
     */
    private $agentId;
    /**
     * 被删除的规则id
     */
    private $ruleId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agentId'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setRuleId($ruleId)
    {
        $this->ruleId = $ruleId;
        $this->apiParas['ruleId'] = $ruleId;
    }

    public function getRuleId()
    {
        return $this->ruleId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.rule.delete';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
