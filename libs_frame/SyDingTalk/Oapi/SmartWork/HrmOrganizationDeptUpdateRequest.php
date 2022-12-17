<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.organization.dept.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.24
 */
class HrmOrganizationDeptUpdateRequest extends BaseRequest
{
    /**
     * 系统自动生成
     */
    private $attributeVOS;
    /**
     * 部门ID
     */
    private $deptId;

    public function setAttributeVOS($attributeVOS)
    {
        $this->attributeVOS = $attributeVOS;
        $this->apiParas['attributeVOS'] = $attributeVOS;
    }

    public function getAttributeVOS()
    {
        return $this->attributeVOS;
    }

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
        return 'dingtalk.oapi.smartwork.hrm.organization.dept.update';
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
