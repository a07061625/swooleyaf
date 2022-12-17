<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.process.procvisible.save request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.24
 */
class ProcVisibleSaveRequest extends BaseRequest
{
    /**
     * 请求
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
        return 'dingtalk.oapi.process.procvisible.save';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
