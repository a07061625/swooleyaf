<?php

namespace SyDingTalk\Oapi;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.get_jsapi_ticket request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetJsApiTicketRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.get_jsapi_ticket';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
