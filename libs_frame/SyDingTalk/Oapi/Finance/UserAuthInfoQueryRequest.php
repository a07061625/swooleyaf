<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.finance.userAuthInfo.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.03
 */
class UserAuthInfoQueryRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.finance.userAuthInfo.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
