<?php

namespace SyDingTalk\Oapi\Live;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.live.query request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class QueryRequest extends BaseRequest
{
    /**
     * 直播查询请求model
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
        return 'dingtalk.oapi.live.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
