<?php

namespace SyDingTalk\Oapi\Org;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.org.listshortcut request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ListShortcutRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.org.listshortcut';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
