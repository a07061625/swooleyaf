<?php

namespace SyDingTalk\Oapi\V2Department;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.v2.department.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.29
 */
class DeleteRequest extends BaseRequest
{
    /**
     * 部门id (注：不能删除根部门；当部门里有员工，或者部门的子部门里有员工，也不能删除)
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
        return 'dingtalk.oapi.v2.department.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deptId, 'deptId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
