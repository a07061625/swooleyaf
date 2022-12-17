<?php

namespace SyDingTalk\Corp\ChatBot;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.chatbot.createorgbot request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class CreateOrgBotRequest extends BaseRequest
{
    /**
     * 创建机器人modle
     */
    private $createChatBotModel;

    public function setCreateChatBotModel($createChatBotModel)
    {
        $this->createChatBotModel = $createChatBotModel;
        $this->apiParas['create_chat_bot_model'] = $createChatBotModel;
    }

    public function getCreateChatBotModel()
    {
        return $this->createChatBotModel;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.chatbot.createorgbot';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
