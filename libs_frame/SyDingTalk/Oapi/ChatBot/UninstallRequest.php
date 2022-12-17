<?php

namespace SyDingTalk\Oapi\ChatBot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chatbot.uninstall request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.25
 */
class UninstallRequest extends BaseRequest
{
    /**
     * 机器人id(钉钉分配)
     */
    private $chatbotId;

    public function setChatbotId($chatbotId)
    {
        $this->chatbotId = $chatbotId;
        $this->apiParas['chatbot_id'] = $chatbotId;
    }

    public function getChatbotId()
    {
        return $this->chatbotId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chatbot.uninstall';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatbotId, 'chatbotId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
