<?php

namespace SyDingTalk\Oapi\ChatBot;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.chatbot.install request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.11
 */
class InstallRequest extends BaseRequest
{
    /**
     * 安装的机器人信息
     */
    private $chatbotVo;

    public function setChatbotVo($chatbotVo)
    {
        $this->chatbotVo = $chatbotVo;
        $this->apiParas['chatbot_vo'] = $chatbotVo;
    }

    public function getChatbotVo()
    {
        return $this->chatbotVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chatbot.install';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
