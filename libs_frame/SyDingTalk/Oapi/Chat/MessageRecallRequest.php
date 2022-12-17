<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.message.recall request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.02
 */
class MessageRecallRequest extends BaseRequest
{
    /**
     * 会话id
     */
    private $chatid;
    /**
     * 消息id
     */
    private $msgid;

    public function setChatid($chatid)
    {
        $this->chatid = $chatid;
        $this->apiParas['chatid'] = $chatid;
    }

    public function getChatid()
    {
        return $this->chatid;
    }

    public function setMsgid($msgid)
    {
        $this->msgid = $msgid;
        $this->apiParas['msgid'] = $msgid;
    }

    public function getMsgid()
    {
        return $this->msgid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chat.message.recall';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatid, 'chatid');
        RequestCheckUtil::checkNotNull($this->msgid, 'msgid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
