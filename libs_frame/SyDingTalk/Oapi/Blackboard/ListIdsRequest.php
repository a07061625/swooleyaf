<?php

namespace SyDingTalk\Oapi\Blackboard;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.blackboard.listids request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.29
 */
class ListIdsRequest extends BaseRequest
{
    /**
     * 请求入参
     */
    private $queryRequest;

    public function setQueryRequest($queryRequest)
    {
        $this->queryRequest = $queryRequest;
        $this->apiParas['query_request'] = $queryRequest;
    }

    public function getQueryRequest()
    {
        return $this->queryRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.blackboard.listids';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
