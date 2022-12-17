<?php

namespace SyDingTalk\Oapi\AliTrip;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.alitrip.btrip.hotel.order.search request
 *
 * @author auto create
 *
 * @since 1.0, 2021.12.27
 */
class BtripHotelOrderSearchRequest extends BaseRequest
{
    /**
     * rq
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
        return 'dingtalk.oapi.alitrip.btrip.hotel.order.search';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
