<?php

namespace SyDingTalk\Oapi\ImPaas;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.impaas.conversation.updateentranceid request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class ConversationUpdateEntranceIdRequest extends BaseRequest
{
    /**
     * 参数结构体
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
        return 'dingtalk.oapi.impaas.conversation.updateentranceid';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
