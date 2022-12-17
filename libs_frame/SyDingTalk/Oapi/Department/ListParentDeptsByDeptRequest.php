<?php

namespace SyDingTalk\Oapi\Department;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.department.list_parent_depts_by_dept request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class ListParentDeptsByDeptRequest extends BaseRequest
{
    /**
     * 部门id
     */
    private $id;

    public function setId($id)
    {
        $this->id = $id;
        $this->apiParas['id'] = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.department.list_parent_depts_by_dept';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
