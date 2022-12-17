<?php

namespace SyDingTalk\Oapi\Industry;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.industry.organization.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.05
 */
class OrganizationGetRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.industry.organization.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
