<?php

namespace SyDingTalk\SmartWork\Bpms;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.smartwork.bpms.processinstance.getwithform request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ProcessInstanceGetWithFormRequest extends BaseRequest
{
    /**
     * 审批实例id
     */
    private $processInstanceId;

    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;
        $this->apiParas['process_instance_id'] = $processInstanceId;
    }

    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.smartwork.bpms.processinstance.getwithform';
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
