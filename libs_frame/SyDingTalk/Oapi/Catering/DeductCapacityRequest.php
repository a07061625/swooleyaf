<?php

namespace SyDingTalk\Oapi\Catering;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.catering.deduct.capacity request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.10
 */
class DeductCapacityRequest extends BaseRequest
{
    /**
     * 用餐时间
     */
    private $meaTime;
    /**
     * 应付金额
     */
    private $orderFullAmount;
    /**
     * 订单id
     */
    private $orderid;
    /**
     * 点餐人userid
     */
    private $userid;

    public function setMeaTime($meaTime)
    {
        $this->meaTime = $meaTime;
        $this->apiParas['mea_time'] = $meaTime;
    }

    public function getMeaTime()
    {
        return $this->meaTime;
    }

    public function setOrderFullAmount($orderFullAmount)
    {
        $this->orderFullAmount = $orderFullAmount;
        $this->apiParas['order_full_amount'] = $orderFullAmount;
    }

    public function getOrderFullAmount()
    {
        return $this->orderFullAmount;
    }

    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;
        $this->apiParas['orderid'] = $orderid;
    }

    public function getOrderid()
    {
        return $this->orderid;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.catering.deduct.capacity';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->meaTime, 'meaTime');
        RequestCheckUtil::checkNotNull($this->orderFullAmount, 'orderFullAmount');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
