<?php

namespace SyDingTalk\Oapi\Ding;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.ding.task.status.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class TaskStatusUpdateRequest extends BaseRequest
{
    /**
     * 操作人id
     */
    private $operatorUserid;
    /**
     * 任务ID
     */
    private $taskId;
    /**
     * 任务状态:1-未完成;2-完成
     */
    private $taskStatus;

    public function setOperatorUserid($operatorUserid)
    {
        $this->operatorUserid = $operatorUserid;
        $this->apiParas['operator_userid'] = $operatorUserid;
    }

    public function getOperatorUserid()
    {
        return $this->operatorUserid;
    }

    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
        $this->apiParas['task_id'] = $taskId;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function setTaskStatus($taskStatus)
    {
        $this->taskStatus = $taskStatus;
        $this->apiParas['task_status'] = $taskStatus;
    }

    public function getTaskStatus()
    {
        return $this->taskStatus;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ding.task.status.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
