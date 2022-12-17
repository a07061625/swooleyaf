<?php

namespace SyDingTalk\Corp\Liveness;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.liveness.get request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.liveness.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
