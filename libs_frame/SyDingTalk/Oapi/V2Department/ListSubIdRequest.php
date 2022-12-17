<?php

namespace SyDingTalk\Oapi\V2Department;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.v2.department.listsubid request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.10
 */
class ListSubIdRequest extends BaseRequest
{
    /**
     * 父部门id，根部门传1
     */
    private $deptId;

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.v2.department.listsubid';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
