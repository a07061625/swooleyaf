<?php

namespace SyDingTalk\Oapi\Blackboard;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.blackboard.get request
 *
 * @author auto create
 *
 * @since 1.0, 2022.03.09
 */
class GetRequest extends BaseRequest
{
    /**
     * 公告id
     */
    private $blackboardId;
    /**
     * 操作人userId
     */
    private $operationUserid;

    public function setBlackboardId($blackboardId)
    {
        $this->blackboardId = $blackboardId;
        $this->apiParas['blackboard_id'] = $blackboardId;
    }

    public function getBlackboardId()
    {
        return $this->blackboardId;
    }

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
        return 'dingtalk.oapi.blackboard.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->blackboardId, 'blackboardId');
        RequestCheckUtil::checkNotNull($this->operationUserid, 'operationUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
