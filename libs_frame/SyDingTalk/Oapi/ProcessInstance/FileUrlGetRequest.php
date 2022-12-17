<?php

namespace SyDingTalk\Oapi\ProcessInstance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.processinstance.file.url.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.25
 */
class FileUrlGetRequest extends BaseRequest
{
    /**
     * 入参
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
        return 'dingtalk.oapi.processinstance.file.url.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
