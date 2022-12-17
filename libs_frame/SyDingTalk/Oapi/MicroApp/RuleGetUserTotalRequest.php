<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.microapp.rule.get_user_total request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class RuleGetUserTotalRequest extends BaseRequest
{
    /**
     * 规则所属的微应用agentId
     */
    private $agentId;
    /**
     * 需要查询的规则id集合
     */
    private $ruleIdList;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agentId'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setRuleIdList($ruleIdList)
    {
        $this->ruleIdList = $ruleIdList;
        $this->apiParas['ruleIdList'] = $ruleIdList;
    }

    public function getRuleIdList()
    {
        return $this->ruleIdList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.rule.get_user_total';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
