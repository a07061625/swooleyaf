<?php

namespace SyDingTalk\Oapi\ProcessInstance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.processinstance.cspace.preview request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.05
 */
class CspacePreviewRequest extends BaseRequest
{
    /**
     * request
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
        return 'dingtalk.oapi.processinstance.cspace.preview';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
