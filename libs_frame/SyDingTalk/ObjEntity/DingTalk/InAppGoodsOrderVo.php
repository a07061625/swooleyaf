<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 订单信息
 *
 * @author auto create
 */
class InAppGoodsOrderVo
{
    /**
     * 内购商品订单号
     */
    public $biz_order_id;

    /**
     * 购买商品的企业开放Id
     */
    public $corp_id;

    /**
     * 订单创建时间
     */
    public $create_timestamp;

    /**
     * 订购的服务结束时间
     */
    public $end_timestamp;

    /**
     * 内购商品码
     */
    public $goods_code;

    /**
     * 内购商品规格码
     */
    public $item_code;

    /**
     * 订单支付时间
     */
    public $paid_timestamp;

    /**
     * 订购数量，周期型商品此字段为空
     */
    public $quantity;

    /**
     * 订购的服务开始时间
     */
    public $start_timestamp;

    /**
     * 订单状态，0 - 订单关闭，3 - 订单支付，4 - 订单创建
     */
    public $status;

    /**
     * 实际支付总金额，单位为分(RMB)
     */
    public $total_actual_pay_fee;
}
