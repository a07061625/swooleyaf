<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.user.get_admin request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.26
 */
class GetAdminRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.get_admin';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
