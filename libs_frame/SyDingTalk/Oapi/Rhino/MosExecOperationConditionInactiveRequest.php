<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.operation.condition.inactive request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.14
 */
class MosExecOperationConditionInactiveRequest extends BaseRequest
{
    /**
     * 入参
     */
    private $inactiveOperationReq;

    public function setInactiveOperationReq($inactiveOperationReq)
    {
        $this->inactiveOperationReq = $inactiveOperationReq;
        $this->apiParas['inactive_operation_req'] = $inactiveOperationReq;
    }

    public function getInactiveOperationReq()
    {
        return $this->inactiveOperationReq;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.exec.operation.condition.inactive';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
