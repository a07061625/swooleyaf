<?php

namespace SyDingTalk\Oapi\Blackboard;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.blackboard.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.06.16
 */
class CreateRequest extends BaseRequest
{
    /**
     * 请求入参
     */
    private $createRequest;

    public function setCreateRequest($createRequest)
    {
        $this->createRequest = $createRequest;
        $this->apiParas['create_request'] = $createRequest;
    }

    public function getCreateRequest()
    {
        return $this->createRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.blackboard.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
