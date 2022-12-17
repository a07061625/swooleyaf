<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.message.send request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class MessageSendRequest extends BaseRequest
{
    /**
     * 消息对象
     */
    private $message;

    public function setMessage($message)
    {
        $this->message = $message;
        $this->apiParas['message'] = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.message.send';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
