<?php

namespace SyDingTalk\Oapi\Blackboard;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.blackboard.category.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.29
 */
class CategoryListRequest extends BaseRequest
{
    /**
     * 操作人userId(必须是公告管理员)
     */
    private $operationUserid;

    public function setOperationUserid($operationUserid)
    {
        $this->operationUserid = $operationUserid;
        $this->apiParas['operation_userid'] = $operationUserid;
    }

    public function getOperationUserid()
    {
        return $this->operationUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.blackboard.category.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->operationUserid, 'operationUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
