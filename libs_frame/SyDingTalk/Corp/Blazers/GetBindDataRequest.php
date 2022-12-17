<?php

namespace SyDingTalk\Corp\Blazers;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.blazers.getbinddata request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetBindDataRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.blazers.getbinddata';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
