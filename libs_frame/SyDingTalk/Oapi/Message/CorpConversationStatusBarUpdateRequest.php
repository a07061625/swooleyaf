<?php

namespace SyDingTalk\Oapi\Message;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.message.corpconversation.status_bar.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.06.09
 */
class CorpConversationStatusBarUpdateRequest extends BaseRequest
{
    /**
     * 应用id
     */
    private $agentId;
    /**
     * 状态栏背景色
     */
    private $statusBg;
    /**
     * 状态栏值
     */
    private $statusValue;
    /**
     * 工作通知任务id
     */
    private $taskId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setStatusBg($statusBg)
    {
        $this->statusBg = $statusBg;
        $this->apiParas['status_bg'] = $statusBg;
    }

    public function getStatusBg()
    {
        return $this->statusBg;
    }

    public function setStatusValue($statusValue)
    {
        $this->statusValue = $statusValue;
        $this->apiParas['status_value'] = $statusValue;
    }

    public function getStatusValue()
    {
        return $this->statusValue;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.message.corpconversation.status_bar.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->statusValue, 'statusValue');
        RequestCheckUtil::checkNotNull($this->taskId, 'taskId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
