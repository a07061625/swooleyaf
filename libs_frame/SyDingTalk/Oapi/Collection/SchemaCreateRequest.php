<?php

namespace SyDingTalk\Oapi\Collection;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.collection.schema.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.17
 */
class SchemaCreateRequest extends BaseRequest
{
    /**
     * 根请求
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
        return 'dingtalk.oapi.collection.schema.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
