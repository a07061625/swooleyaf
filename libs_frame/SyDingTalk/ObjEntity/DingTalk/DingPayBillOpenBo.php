<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * billList
 *
 * @author auto create
 */
class DingPayBillOpenBo
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
     * INCOME收入、EXPENSE支出
     */
    public $bill_category;

    /**
     * 账单号
     */
    public $bill_no;

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
     * 订单号
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
     * 收款方真实账号
     */
    public $pay_channel_payee_real_uid;

    /**
     * 支付渠道方付款者实际出资UID
     */
    public $pay_channel_payer_real_uid;

    /**
     * 收款者corpId或者userId
     */
    public $payee_id;

    /**
     * 收款者类型
     */
    public $payee_user_type;

    /**
     * 付款者corpId或者userId
     */
    public $payer_id;

    /**
     * 付款者类型
     */
    public $payer_user_type;

    /**
     * 记账主体corpId或者userId
     */
    public $principal_id;

    /**
     * 收款人账户类型
     */
    public $receiptor_type;

    /**
     * 来源应用ID
     */
    public $source_app_id;

    /**
     * 状态
     */
    public $status;

    /**
     * 中止操作员id
     */
    public $termination_operator_id;

    /**
     * 中止支付原因
     */
    public $termination_reason;

    /**
     * 标题
     */
    public $title;
}
