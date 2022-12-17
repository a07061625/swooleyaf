<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingpay.order.syncstatus request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class OrderSyncStatusRequest extends BaseRequest
{
    /**
     * 钉支付订单号
     */
    private $orderNos;

    public function setOrderNos($orderNos)
    {
        $this->orderNos = $orderNos;
        $this->apiParas['order_nos'] = $orderNos;
    }

    public function getOrderNos()
    {
        return $this->orderNos;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingpay.order.syncstatus';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->orderNos, 'orderNos');
        RequestCheckUtil::checkMaxListSize($this->orderNos, 20, 'orderNos');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
