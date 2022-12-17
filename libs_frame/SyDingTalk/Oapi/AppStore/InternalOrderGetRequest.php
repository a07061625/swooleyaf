<?php

namespace SyDingTalk\Oapi\AppStore;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.appstore.internal.order.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.16
 */
class InternalOrderGetRequest extends BaseRequest
{
    /**
     * 内购商品订单号
     */
    private $bizOrderId;

    public function setBizOrderId($bizOrderId)
    {
        $this->bizOrderId = $bizOrderId;
        $this->apiParas['biz_order_id'] = $bizOrderId;
    }

    public function getBizOrderId()
    {
        return $this->bizOrderId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.appstore.internal.order.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizOrderId, 'bizOrderId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
