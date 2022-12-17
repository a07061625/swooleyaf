<?php

namespace SyDingTalk\Oapi\Kac;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.kac.datav.dept.videolive.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.11.30
 */
class DatavDeptVideoLiveListRequest extends BaseRequest
{
    /**
     * 请求对象
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
        return 'dingtalk.oapi.kac.datav.dept.videolive.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
