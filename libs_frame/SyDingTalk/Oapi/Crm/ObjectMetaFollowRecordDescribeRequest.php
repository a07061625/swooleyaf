<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.crm.objectmeta.followrecord.describe request
 *
 * @author auto create
 *
 * @since 1.0, 2021.11.22
 */
class ObjectMetaFollowRecordDescribeRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.objectmeta.followrecord.describe';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
