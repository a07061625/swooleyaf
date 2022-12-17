<?php

namespace SyDingTalk\Oapi\FuGong;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.fugong.process_code.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.12
 */
class ProcessCodeGetRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.fugong.process_code.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
