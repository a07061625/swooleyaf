<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingpay.order.markotherpay request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class OrderMarkOtherPayRequest extends BaseRequest
{
    /**
     * 标记支付的操作员userId
     */
    private $applyPayOperatorUserid;
    /**
     * 扩展属性
     */
    private $extension;
    /**
     * 钉支付订单号
     */
    private $orderNos;
    /**
     * 真实支付宝UID
     */
    private $payChannelPayerRealUid;

    public function setApplyPayOperatorUserid($applyPayOperatorUserid)
    {
        $this->applyPayOperatorUserid = $applyPayOperatorUserid;
        $this->apiParas['apply_pay_operator_userid'] = $applyPayOperatorUserid;
    }

    public function getApplyPayOperatorUserid()
    {
        return $this->applyPayOperatorUserid;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
        $this->apiParas['extension'] = $extension;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setOrderNos($orderNos)
    {
        $this->orderNos = $orderNos;
        $this->apiParas['order_nos'] = $orderNos;
    }

    public function getOrderNos()
    {
        return $this->orderNos;
    }

    public function setPayChannelPayerRealUid($payChannelPayerRealUid)
    {
        $this->payChannelPayerRealUid = $payChannelPayerRealUid;
        $this->apiParas['pay_channel_payer_real_uid'] = $payChannelPayerRealUid;
    }

    public function getPayChannelPayerRealUid()
    {
        return $this->payChannelPayerRealUid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingpay.order.markotherpay';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->orderNos, 20, 'orderNos');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
