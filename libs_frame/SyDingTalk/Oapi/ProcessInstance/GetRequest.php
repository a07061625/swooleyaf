<?php

namespace SyDingTalk\Oapi\ProcessInstance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.processinstance.get request
 * @author auto create
 * @since 1.0, 2020.11.23
 */
class GetRequest extends BaseRequest
{
    /**
     * 审批实例id
     **/
    private $processInstanceId;

    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;
        $this->apiParas["process_instance_id"] = $processInstanceId;
    }

    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.processinstance.get";
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->processInstanceId, "processInstanceId");
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
