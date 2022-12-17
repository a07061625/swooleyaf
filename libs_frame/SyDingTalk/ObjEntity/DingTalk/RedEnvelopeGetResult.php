<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 红包查询结果
 *
 * @author auto create
 */
class RedEnvelopeGetResult
{
    /**
     * 企业订单号，企业传入
     */
    public $corp_biz_no;

    /**
     * 红包祝福语
     */
    public $greetings;

    /**
     * 红包订单号
     */
    public $order_no;

    /**
     * 红包领取金额
     */
    public $pick_amount;

    /**
     * 红包领取时间
     */
    public $pick_time;

    /**
     * 红包接收人ID
     */
    public $receiver_id;

    /**
     * 红包退款金额
     */
    public $refund_amount;

    /**
     * 红包退款时间
     */
    public $refund_time;

    /**
     * 红包发送时间
     */
    public $send_time;

    /**
     * 红包发送人ID，当红包类型为SINGLE_QUOTA时有值
     */
    public $sender_id;

    /**
     * 红包状态
     */
    public $status;

    /**
     * 红包主题ID
     */
    public $theme_id;

    /**
     * 红包金额
     */
    public $total_amount;

    /**
     * 红包类型
     */
    public $type;
}
