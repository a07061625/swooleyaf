<?php

namespace SyDingTalk\Oapi\AliTrip;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.alitrip.btrip.approval.update request
 * @author auto create
 * @since 1.0, 2019.07.01
 */
class BtripApprovalUpdateRequest extends BaseRequest
{
    /**
     * 请求对象
     **/
    private $rq;

    public function setRq($rq)
    {
        $this->rq = $rq;
        $this->apiParas["rq"] = $rq;
    }

    public function getRq()
    {
        return $this->rq;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.alitrip.btrip.approval.update";
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
