<?php

namespace SyDingTalk\Oapi\AppStore;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.appstore.internal.order.finish request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class InternalOrderFinishRequest extends BaseRequest
{
    /**
     * 内购订单号
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
        return 'dingtalk.oapi.appstore.internal.order.finish';
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
