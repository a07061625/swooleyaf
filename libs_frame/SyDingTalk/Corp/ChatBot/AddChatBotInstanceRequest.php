<?php

namespace SyDingTalk\Corp\ChatBot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.chatbot.addchatbotinstance request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.18
 */
class AddChatBotInstanceRequest extends BaseRequest
{
    /**
     * 机器人id，由钉钉事先分配
     */
    private $chatbotId;
    /**
     * 机器人头像(如果为空，默认是机器人安装时的头像)
     */
    private $iconMediaId;
    /**
     * 机器人名字(如果为空，默认是机器人安装时的名字)
     */
    private $name;
    /**
     * 创建群时返回的openConvsationId
     */
    private $openConversationId;

    public function setChatbotId($chatbotId)
    {
        $this->chatbotId = $chatbotId;
        $this->apiParas['chatbot_id'] = $chatbotId;
    }

    public function getChatbotId()
    {
        return $this->chatbotId;
    }

    public function setIconMediaId($iconMediaId)
    {
        $this->iconMediaId = $iconMediaId;
        $this->apiParas['icon_media_id'] = $iconMediaId;
    }

    public function getIconMediaId()
    {
        return $this->iconMediaId;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

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
        return 'dingtalk.corp.chatbot.addchatbotinstance';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatbotId, 'chatbotId');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
