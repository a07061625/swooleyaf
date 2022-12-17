<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.servicegroup.disband request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.22
 */
class ChatServiceGroupDisbandRequest extends BaseRequest
{
    /**
     * 开放的chatId
     */
    private $chatId;

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
        $this->apiParas['chat_id'] = $chatId;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.servicegroup.disband';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatId, 'chatId');
        RequestCheckUtil::checkMaxLength($this->chatId, 128, 'chatId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
