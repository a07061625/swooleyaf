<?php

namespace SyDingTalk\Oapi\V2Department;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.v2.department.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.25
 */
class GetRequest extends BaseRequest
{
    /**
     * 部门id，根部门ID为1
     */
    private $deptId;
    /**
     * 通讯录语言（默认zh_CN）
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
        return 'dingtalk.oapi.v2.department.get';
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
