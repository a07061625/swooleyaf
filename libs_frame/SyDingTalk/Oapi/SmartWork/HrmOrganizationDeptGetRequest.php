<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.organization.dept.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.19
 */
class HrmOrganizationDeptGetRequest extends BaseRequest
{
    /**
     * 部门ID
     */
    private $deptId;
    /**
     * 字段 code 列表
     */
    private $fieldCodeList;

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function setFieldCodeList($fieldCodeList)
    {
        $this->fieldCodeList = $fieldCodeList;
        $this->apiParas['field_code_list'] = $fieldCodeList;
    }

    public function getFieldCodeList()
    {
        return $this->fieldCodeList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.organization.dept.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deptId, 'deptId');
        RequestCheckUtil::checkNotNull($this->fieldCodeList, 'fieldCodeList');
        RequestCheckUtil::checkMaxListSize($this->fieldCodeList, 999, 'fieldCodeList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
