<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 账单分期期次信息，借款失败时传空数组
 *
 * @author auto create
 */
class BillInfo
{
    /**
     * 本期账单日，样例
     */
    public $bill_date;

    /**
     * 期次已还罚息(单位：分，没有则为0)=本金罚息+利息罚息
     */
    public $paid_penalty;

    /**
     * 期次已还利息(单位：分)
     */
    public $paid_pnterest;

    /**
     * 期次已还本金(单位：分)
     */
    public $paid_principal;

    /**
     * 期次已还总金额(单位：分)：已还本金+已还利息+已还罚息
     */
    public $paid_total_amount;

    /**
     * 期次应还利息(单位：分)
     */
    public $payable_interest;

    /**
     * 期次应还罚息(单位：分，没有则为0)=本金罚息+利息罚息
     */
    public $payable_penalty;

    /**
     * 期次应还本金(单位：分)
     */
    public $payable_principal;

    /**
     * 期次应还总金额(单位：分)：应还本金+应还利息+应还罚息
     */
    public $payable_total_amount;

    /**
     * 本期还款日，如每月5号
     */
    public $repay_date;

    /**
     * 本期还款状态：INIT 未还款、ONGOING 还款中、PAID 已还清、OVERDUE 已逾期、FAIL 还款失败
     */
    public $status;

    /**
     * 本期期次：2=第2期
     */
    public $terms;
}
