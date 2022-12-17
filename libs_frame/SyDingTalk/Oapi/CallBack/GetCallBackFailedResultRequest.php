<?php

namespace SyDingTalk\Oapi\CallBack;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.call_back.get_call_back_failed_result request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetCallBackFailedResultRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.call_back.get_call_back_failed_result';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
