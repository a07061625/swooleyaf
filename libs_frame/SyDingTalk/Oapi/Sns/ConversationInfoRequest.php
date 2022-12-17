<?php

namespace SyDingTalk\Oapi\Sns;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.sns.conversation.info request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.15
 */
class ConversationInfoRequest extends BaseRequest
{
    /**
     * 会话ID
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
        return 'dingtalk.oapi.sns.conversation.info';
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
