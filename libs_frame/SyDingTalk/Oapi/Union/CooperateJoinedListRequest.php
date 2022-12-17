<?php

namespace SyDingTalk\Oapi\Union;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.union.cooperate.joined.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.13
 */
class CooperateJoinedListRequest extends BaseRequest
{
    /**
     * 加入空间的状态 0：申请中的 1：成功加入的
     */
    private $status;

    public function setStatus($status)
    {
        $this->status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.union.cooperate.joined.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->status, 'status');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
