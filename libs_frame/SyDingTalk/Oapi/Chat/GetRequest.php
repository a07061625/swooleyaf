<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.chat.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.12
 */
class GetRequest extends BaseRequest
{
    /**
     * 群会话的id
     */
    private $chatid;

    public function setChatid($chatid)
    {
        $this->chatid = $chatid;
        $this->apiParas['chatid'] = $chatid;
    }

    public function getChatid()
    {
        return $this->chatid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chat.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
