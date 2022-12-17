<?php

namespace SyDingTalk\Oapi\ProcessInstance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.processinstance.variable.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.13
 */
class VariableUpdateRequest extends BaseRequest
{
    /**
     * 审批实例id
     */
    private $processInstanceId;
    /**
     * 备注
     */
    private $remark;
    /**
     * 变量列表
     */
    private $variables;

    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;
        $this->apiParas['process_instance_id'] = $processInstanceId;
    }

    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    public function setRemark($remark)
    {
        $this->remark = $remark;
        $this->apiParas['remark'] = $remark;
    }

    public function getRemark()
    {
        return $this->remark;
    }

    public function setVariables($variables)
    {
        $this->variables = $variables;
        $this->apiParas['variables'] = $variables;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.processinstance.variable.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->processInstanceId, 'processInstanceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
