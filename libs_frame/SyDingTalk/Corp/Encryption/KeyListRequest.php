<?php

namespace SyDingTalk\Corp\Encryption;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.encryption.key.list request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class KeyListRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.encryption.key.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
