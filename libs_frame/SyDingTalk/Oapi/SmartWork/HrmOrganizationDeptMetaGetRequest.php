<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.organization.dept.meta.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.26
 */
class HrmOrganizationDeptMetaGetRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.organization.dept.meta.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
