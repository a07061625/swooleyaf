<?php

namespace SyDingTalk\Oapi\CallBack;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.call_back.delete_call_back request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class DeleteCallBackRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.call_back.delete_call_back';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
