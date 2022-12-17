<?php

namespace SyDingTalk\Oapi\Org;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.org.union.branch.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.29
 */
class UnionBranchGetRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.org.union.branch.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
