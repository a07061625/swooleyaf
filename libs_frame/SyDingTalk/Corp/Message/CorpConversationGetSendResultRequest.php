<?php

namespace SyDingTalk\Corp\Message;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.message.corpconversation.getsendresult request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class CorpConversationGetSendResultRequest extends BaseRequest
{
    /**
     * 微应用的agentid
     */
    private $agentId;
    /**
     * 异步任务的id
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
        return 'dingtalk.corp.message.corpconversation.getsendresult';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
