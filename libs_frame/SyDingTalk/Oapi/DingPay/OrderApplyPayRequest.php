<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingpay.order.applypay request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.31
 */
class OrderApplyPayRequest extends BaseRequest
{
    /**
     * 发起支付操作员userId
     */
    private $applyPayOperatorUserid;
    /**
     * 扩展属性
     */
    private $extension;
    /**
     * 订单号
     */
    private $orderNos;
    /**
     * 支付渠道
     */
    private $payChannel;
    /**
     * 支付渠道方付款者真实出资UID
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

    public function setPayChannel($payChannel)
    {
        $this->payChannel = $payChannel;
        $this->apiParas['pay_channel'] = $payChannel;
    }

    public function getPayChannel()
    {
        return $this->payChannel;
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
        return 'dingtalk.oapi.dingpay.order.applypay';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->applyPayOperatorUserid, 'applyPayOperatorUserid');
        RequestCheckUtil::checkNotNull($this->orderNos, 'orderNos');
        RequestCheckUtil::checkMaxListSize($this->orderNos, 20, 'orderNos');
        RequestCheckUtil::checkNotNull($this->payChannel, 'payChannel');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
