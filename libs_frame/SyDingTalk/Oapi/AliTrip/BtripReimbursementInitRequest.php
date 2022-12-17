<?php

namespace SyDingTalk\Oapi\AliTrip;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.alitrip.btrip.reimbursement.init request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.11
 */
class BtripReimbursementInitRequest extends BaseRequest
{
    /**
     * 入参，创建报销单参数
     */
    private $rq;

    public function setRq($rq)
    {
        $this->rq = $rq;
        $this->apiParas['rq'] = $rq;
    }

    public function getRq()
    {
        return $this->rq;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.alitrip.btrip.reimbursement.init';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
