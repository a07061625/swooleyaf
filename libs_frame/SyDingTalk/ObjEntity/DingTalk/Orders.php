<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * orders
 *
 * @author auto create
 */
class Orders
{
    /**
     * 金额（单位：分）
     */
    public $amount;

    /**
     * 发起支付操作员userId
     */
    public $apply_pay_operator_userid;

    /**
     * 业务代码
     */
    public $biz_code;

    /**
     * 创单操作员userId
     */
    public $create_operator_userid;

    /**
     * 扩展属性
     */
    public $extension;

    /**
     * 申请支付时间
     */
    public $gmt_apply_pay;

    /**
     * 创单时间
     */
    public $gmt_create;

    /**
     * 记录更新时间
     */
    public $gmt_modified;

    /**
     * 完成付款时间
     */
    public $gmt_pay;

    /**
     * 钉支付订单号
     */
    public $order_no;

    /**
     * 外部流水号
     */
    public $out_biz_no;

    /**
     * 支付渠道
     */
    public $pay_channel;

    /**
     * 支付渠道方流水号
     */
    public $pay_channel_biz_no;

    /**
     * 支付渠道方付款者UID
     */
    public $pay_channel_payer_real_uid;

    /**
     * 收款方corpId或者userId
     */
    public $payee_id;

    /**
     * 收款方类型
     */
    public $payee_user_type;

    /**
     * 付款方corpId或者userId
     */
    public $payer_id;

    /**
     * 付款方类型
     */
    public $payer_user_type;

    /**
     * 来源应用ID
     */
    public $source_app_id;

    /**
     * 订单状态
     */
    public $status;

    /**
     * 标题
     */
    public $title;
}
