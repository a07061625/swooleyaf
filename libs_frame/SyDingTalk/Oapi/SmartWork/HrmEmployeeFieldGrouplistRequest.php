<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.employee.field.grouplist request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.19
 */
class HrmEmployeeFieldGrouplistRequest extends BaseRequest
{
    /**
     * 微应用在企业的AgentId，不需要自定义字段可不传
     */
    private $agentid;

    public function setAgentid($agentid)
    {
        $this->agentid = $agentid;
        $this->apiParas['agentid'] = $agentid;
    }

    public function getAgentid()
    {
        return $this->agentid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.employee.field.grouplist';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
