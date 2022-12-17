<?php

namespace SyDingTalk\Oapi\Industry;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.industry.department.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.05
 */
class DepartmentGetRequest extends BaseRequest
{
    /**
     * 部门ID
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
        return 'dingtalk.oapi.industry.department.get';
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
