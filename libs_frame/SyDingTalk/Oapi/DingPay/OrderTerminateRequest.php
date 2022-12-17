<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingpay.order.terminate request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class OrderTerminateRequest extends BaseRequest
{
    /**
     * 扩展信息
     */
    private $extension;
    /**
     * 操作者员工号
     */
    private $operator;
    /**
     * dingpay单号列表
     */
    private $orderNos;
    /**
     * 中止原因
     */
    private $reason;

    public function setExtension($extension)
    {
        $this->extension = $extension;
        $this->apiParas['extension'] = $extension;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setOperator($operator)
    {
        $this->operator = $operator;
        $this->apiParas['operator'] = $operator;
    }

    public function getOperator()
    {
        return $this->operator;
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

    public function setReason($reason)
    {
        $this->reason = $reason;
        $this->apiParas['reason'] = $reason;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingpay.order.terminate';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->operator, 'operator');
        RequestCheckUtil::checkNotNull($this->orderNos, 'orderNos');
        RequestCheckUtil::checkMaxListSize($this->orderNos, 20, 'orderNos');
        RequestCheckUtil::checkNotNull($this->reason, 'reason');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
