<?php

namespace SyDingTalk\Corp\Invoice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.invoice.gettitle request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetTitleRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.invoice.gettitle';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
