<?php

namespace SyDingTalk\Oapi\Auth;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.auth.scopes request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class ScopesRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.auth.scopes';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
