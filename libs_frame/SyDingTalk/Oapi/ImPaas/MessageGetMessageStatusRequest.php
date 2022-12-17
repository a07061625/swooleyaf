<?php

namespace SyDingTalk\Oapi\ImPaas;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.impaas.message.getmessagestatus request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class MessageGetMessageStatusRequest extends BaseRequest
{
    /**
     * 根据异步发送时返回的taskid获取消息
     */
    private $request;

    public function setRequest($request)
    {
        $this->request = $request;
        $this->apiParas['request'] = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.impaas.message.getmessagestatus';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
