<?php

namespace SyDingTalk\Oapi\AliTrip;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.alitrip.btrip.category.address.get request
 *
 * @author auto create
 *
 * @since 1.0, 2018.08.07
 */
class BtripCategoryAddressGetRequest extends BaseRequest
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
        return 'dingtalk.oapi.alitrip.btrip.category.address.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
