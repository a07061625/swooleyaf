<?php

namespace SyDingTalk\Corp\ChatBot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.chatbot.listbychatbotids request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.18
 */
class ListByChatBotIdsRequest extends BaseRequest
{
    /**
     * chatbotId列表
     */
    private $chatbotIds;

    public function setChatbotIds($chatbotIds)
    {
        $this->chatbotIds = $chatbotIds;
        $this->apiParas['chatbot_ids'] = $chatbotIds;
    }

    public function getChatbotIds()
    {
        return $this->chatbotIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.chatbot.listbychatbotids';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatbotIds, 'chatbotIds');
        RequestCheckUtil::checkMaxListSize($this->chatbotIds, 20, 'chatbotIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
