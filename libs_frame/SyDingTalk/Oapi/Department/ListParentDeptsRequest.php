<?php

namespace SyDingTalk\Oapi\Department;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.department.list_parent_depts request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class ListParentDeptsRequest extends BaseRequest
{
    /**
     * 用户userId
     */
    private $userId;

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->apiParas['userId'] = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.department.list_parent_depts';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
