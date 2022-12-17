<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.employee.unionexport request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class HrmEmployeeUnionExportRequest extends BaseRequest
{
    /**
     * 导出请求对象
     */
    private $param;

    public function setParam($param)
    {
        $this->param = $param;
        $this->apiParas['param'] = $param;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.employee.unionexport';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
