<?php

namespace SyDingTalk\Oapi\ServiceGroup;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.servicegroup.message.send request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.17
 */
class MessageSendRequest extends BaseRequest
{
    /**
     * 消息对象
     */
    private $conversationMessage;
    /**
     * 订单id
     */
    private $orderId;

    public function setConversationMessage($conversationMessage)
    {
        $this->conversationMessage = $conversationMessage;
        $this->apiParas['conversation_message'] = $conversationMessage;
    }

    public function getConversationMessage()
    {
        return $this->conversationMessage;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        $this->apiParas['order_id'] = $orderId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.servicegroup.message.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->orderId, 'orderId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
