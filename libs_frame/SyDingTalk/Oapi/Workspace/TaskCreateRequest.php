<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workspace.task.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.20
 */
class TaskCreateRequest extends BaseRequest
{
    /**
     * 微应用agentId
     */
    private $microappAgentId;
    /**
     * 操作者id
     */
    private $operatorUserid;
    /**
     * 请求入参
     */
    private $task;

    public function setMicroappAgentId($microappAgentId)
    {
        $this->microappAgentId = $microappAgentId;
        $this->apiParas['microapp_agent_id'] = $microappAgentId;
    }

    public function getMicroappAgentId()
    {
        return $this->microappAgentId;
    }

    public function setOperatorUserid($operatorUserid)
    {
        $this->operatorUserid = $operatorUserid;
        $this->apiParas['operator_userid'] = $operatorUserid;
    }

    public function getOperatorUserid()
    {
        return $this->operatorUserid;
    }

    public function setTask($task)
    {
        $this->task = $task;
        $this->apiParas['task'] = $task;
    }

    public function getTask()
    {
        return $this->task;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.task.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->operatorUserid, 'operatorUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
