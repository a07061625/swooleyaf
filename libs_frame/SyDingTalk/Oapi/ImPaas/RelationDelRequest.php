<?php

namespace SyDingTalk\Oapi\ImPaas;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.impaas.relation.del request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class RelationDelRequest extends BaseRequest
{
    /**
     * 关系
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
        return 'dingtalk.oapi.impaas.relation.del';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
