<?php

namespace SyDingTalk\Corp\Conversation;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.conversation.corpconversion.getconversation request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.21
 */
class CorpConversionGetConversationRequest extends BaseRequest
{
    /**
     * 群组ID
     */
    private $openConversationId;

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.conversation.corpconversion.getconversation';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
