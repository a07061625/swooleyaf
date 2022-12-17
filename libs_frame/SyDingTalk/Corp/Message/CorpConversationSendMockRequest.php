<?php

namespace SyDingTalk\Corp\Message;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.message.corpconversation.sendmock request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class CorpConversationSendMockRequest extends BaseRequest
{
    /**
     * 消息体
     */
    private $message;
    /**
     * 消息类型
     */
    private $messageType;
    /**
     * 微应用agentId
     */
    private $microappAgentId;
    /**
     * 消息接收者部门列表
     */
    private $toParty;
    /**
     * 消息接收者userid列表
     */
    private $toUser;

    public function setMessage($message)
    {
        $this->message = $message;
        $this->apiParas['message'] = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;
        $this->apiParas['message_type'] = $messageType;
    }

    public function getMessageType()
    {
        return $this->messageType;
    }

    public function setMicroappAgentId($microappAgentId)
    {
        $this->microappAgentId = $microappAgentId;
        $this->apiParas['microapp_agent_id'] = $microappAgentId;
    }

    public function getMicroappAgentId()
    {
        return $this->microappAgentId;
    }

    public function setToParty($toParty)
    {
        $this->toParty = $toParty;
        $this->apiParas['to_party'] = $toParty;
    }

    public function getToParty()
    {
        return $this->toParty;
    }

    public function setToUser($toUser)
    {
        $this->toUser = $toUser;
        $this->apiParas['to_user'] = $toUser;
    }

    public function getToUser()
    {
        return $this->toUser;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.message.corpconversation.sendmock';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->message, 'message');
        RequestCheckUtil::checkNotNull($this->messageType, 'messageType');
        RequestCheckUtil::checkNotNull($this->microappAgentId, 'microappAgentId');
        RequestCheckUtil::checkNotNull($this->toParty, 'toParty');
        RequestCheckUtil::checkMaxListSize($this->toParty, 20, 'toParty');
        RequestCheckUtil::checkNotNull($this->toUser, 'toUser');
        RequestCheckUtil::checkMaxListSize($this->toUser, 20, 'toUser');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
