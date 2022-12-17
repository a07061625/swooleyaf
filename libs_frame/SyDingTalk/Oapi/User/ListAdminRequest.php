<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.user.listadmin request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.13
 */
class ListAdminRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.listadmin';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
