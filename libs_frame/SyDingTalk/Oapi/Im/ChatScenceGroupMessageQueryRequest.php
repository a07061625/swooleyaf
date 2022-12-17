<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scencegroup.message.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.06
 */
class ChatScenceGroupMessageQueryRequest extends BaseRequest
{
    /**
     * 群标识
     */
    private $openConversationId;
    /**
     * 消息标识
     */
    private $openMsgId;
    /**
     * 消息发送人的unionId（跟userId二选一）
     */
    private $senderUnionId;
    /**
     * 消息发送人的userId（跟unionId二选一）
     */
    private $senderUserid;

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function setOpenMsgId($openMsgId)
    {
        $this->openMsgId = $openMsgId;
        $this->apiParas['open_msg_id'] = $openMsgId;
    }

    public function getOpenMsgId()
    {
        return $this->openMsgId;
    }

    public function setSenderUnionId($senderUnionId)
    {
        $this->senderUnionId = $senderUnionId;
        $this->apiParas['sender_union_id'] = $senderUnionId;
    }

    public function getSenderUnionId()
    {
        return $this->senderUnionId;
    }

    public function setSenderUserid($senderUserid)
    {
        $this->senderUserid = $senderUserid;
        $this->apiParas['sender_userid'] = $senderUserid;
    }

    public function getSenderUserid()
    {
        return $this->senderUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.scencegroup.message.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
        RequestCheckUtil::checkNotNull($this->openMsgId, 'openMsgId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
