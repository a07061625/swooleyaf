<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.employee.listbycert request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class HrmEmployeeListByCertRequest extends BaseRequest
{
    /**
     * 查询参数
     */
    private $params;

    public function setParams($params)
    {
        $this->params = $params;
        $this->apiParas['params'] = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.employee.listbycert';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
