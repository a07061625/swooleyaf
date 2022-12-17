<?php

namespace SyDingTalk\Oapi\AliTrip;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.alitrip.btrip.flight.city.suggest request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.24
 */
class BtripFlightCitySuggestRequest extends BaseRequest
{
    /**
     * 请求对象
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
        return 'dingtalk.oapi.alitrip.btrip.flight.city.suggest';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
