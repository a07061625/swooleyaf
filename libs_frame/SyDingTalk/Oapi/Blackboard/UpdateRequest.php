<?php

namespace SyDingTalk\Oapi\Blackboard;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.blackboard.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.29
 */
class UpdateRequest extends BaseRequest
{
    /**
     * 请求入参
     */
    private $updateRequest;

    public function setUpdateRequest($updateRequest)
    {
        $this->updateRequest = $updateRequest;
        $this->apiParas['update_request'] = $updateRequest;
    }

    public function getUpdateRequest()
    {
        return $this->updateRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.blackboard.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
