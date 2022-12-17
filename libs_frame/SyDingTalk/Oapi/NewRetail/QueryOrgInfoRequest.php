<?php

namespace SyDingTalk\Oapi\NewRetail;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.newretail.queryorginfo request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class QueryOrgInfoRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.newretail.queryorginfo';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
