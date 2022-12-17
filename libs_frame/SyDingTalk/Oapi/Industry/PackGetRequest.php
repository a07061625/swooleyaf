<?php

namespace SyDingTalk\Oapi\Industry;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.industry.pack.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.14
 */
class PackGetRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.industry.pack.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
