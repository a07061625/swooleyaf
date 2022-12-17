<?php

namespace SyDingTalk\Oapi\V2Department;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.v2.department.listsub request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.13
 */
class ListSubRequest extends BaseRequest
{
    /**
     * 父部门id（如果不传，默认部门为根部门，根部门ID为1）,只支持查询下一级子部门，不支持查询多级子部门
     */
    private $deptId;
    /**
     * 通讯录语言（默认zh_CN，未来会支持en_US）
     */
    private $language;

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        $this->apiParas['language'] = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.v2.department.listsub';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
