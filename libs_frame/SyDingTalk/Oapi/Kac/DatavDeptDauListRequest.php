<?php

namespace SyDingTalk\Oapi\Kac;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.kac.datav.dept.dau.list request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.28
 */
class DatavDeptDauListRequest extends BaseRequest
{
    /**
     * 请求参数对象
     */
    private $request;

    public function setRequest($request)
    {
        $this->request = $request;
        $this->apiParas['request'] = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.kac.datav.dept.dau.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
