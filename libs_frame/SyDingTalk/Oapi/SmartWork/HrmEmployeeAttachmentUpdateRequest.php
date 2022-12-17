<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.employee.attachment.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.21
 */
class HrmEmployeeAttachmentUpdateRequest extends BaseRequest
{
    /**
     * 微应用在企业的AgentId
     */
    private $agentid;
    /**
     * 更新信息
     */
    private $param;

    public function setAgentid($agentid)
    {
        $this->agentid = $agentid;
        $this->apiParas['agentid'] = $agentid;
    }

    public function getAgentid()
    {
        return $this->agentid;
    }

    public function setParam($param)
    {
        $this->param = $param;
        $this->apiParas['param'] = $param;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.employee.attachment.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentid, 'agentid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
