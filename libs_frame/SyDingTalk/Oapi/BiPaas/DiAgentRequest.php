<?php

namespace SyDingTalk\Oapi\BiPaas;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.bipaas.di.agent request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.12
 */
class DiAgentRequest extends BaseRequest
{
    /**
     * 请求体
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
        return 'dingtalk.oapi.bipaas.di.agent';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
