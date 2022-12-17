<?php

namespace SyDingTalk\Corp\Message;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.message.corpconversation.getsendprogress request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class CorpConversationGetSendProgressRequest extends BaseRequest
{
    /**
     * 发送消息时使用的微应用的id
     */
    private $agentId;
    /**
     * 发送消息时钉钉返回的任务id
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
        return 'dingtalk.corp.message.corpconversation.getsendprogress';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->taskId, 'taskId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
