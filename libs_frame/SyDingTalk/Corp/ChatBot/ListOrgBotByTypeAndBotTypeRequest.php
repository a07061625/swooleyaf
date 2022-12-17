<?php

namespace SyDingTalk\Corp\ChatBot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.chatbot.listorgbotbytypeandbottype request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.18
 */
class ListOrgBotByTypeAndBotTypeRequest extends BaseRequest
{
    /**
     * 2-企业对内机器人，3-企业对外机器人
     */
    private $botType;
    /**
     * 机器人类型(钉钉分配)
     */
    private $type;

    public function setBotType($botType)
    {
        $this->botType = $botType;
        $this->apiParas['bot_type'] = $botType;
    }

    public function getBotType()
    {
        return $this->botType;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.chatbot.listorgbotbytypeandbottype';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->botType, 'botType');
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
