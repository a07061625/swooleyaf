<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.loan.notify.repayment.overdue request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.05
 */
class LoanNotifyRepaymentOverdueRequest extends BaseRequest
{
    /**
     * 本次通知未还利息(单位：分)
     */
    private $currentUnpaidInterest;
    /**
     * 本次通知未还罚息(单位：分，精确2位小数，没有则为0)=该期次本金罚息次+该期次利息罚息
     */
    private $currentUnpaidPenalty;
    /**
     * 本次通知未还本金(单位：分）
     */
    private $currentUnpaidPrincipal;
    /**
     * 本次通知未还总金额(单位：分)：未还本金+未还利息+未还罚息
     */
    private $currentUnpaidTotalAmount;
    /**
     * 身份证号
     */
    private $idCardNo;
    /**
     * 利息逾期天数(没有则为0)
     */
    private $intOvdDays;
    /**
     * 借据编号：还款对应的借据编号
     */
    private $loanOrderNo;
    /**
     * 渠道方名称
     */
    private $openChannelName;
    /**
     * 渠道方产品名称
     */
    private $openProductName;
    /**
     * 本次还款时逾期期数(不包括已经还逾期的，没有则为0)：如1=第1期逾期
     */
    private $ovdTerms;
    /**
     * 本次还款利息(单位：分)
     */
    private $paidInterest;
    /**
     * 本次还款罚息(单位：分)
     */
    private $paidPenalty;
    /**
     * 本次还款本金(单位：分)
     */
    private $paidPrincipal;
    /**
     * 本次还款总金额(单位：分)：本次逾期本金+本次逾期利息+本次逾期罚息
     */
    private $paidTotalAmount;
    /**
     * 期次对应借据应还利息(单位：分)
     */
    private $payableInterest;
    /**
     * 期次对应借据应还罚息(单位：分，没有则为0)=本金罚息+利息罚息
     */
    private $payablePenalty;
    /**
     * 期次对应借据应还本金(单位：分)
     */
    private $payablePrincipal;
    /**
     * 期次对应借据应还总金额(单位：分)：应还本金+应还利息+应还罚息
     */
    private $payableTotalAmount;
    /**
     * 该期次已还利息(单位：分)
     */
    private $periodPaidInterest;
    /**
     * 该期次已还罚息(单位：分，精确2位小数，没有则为0)=该期次本金罚息+该期次利息罚息
     */
    private $periodPaidPenalty;
    /**
     * 该期次已还本金(单位：分)
     */
    private $periodPaidPrincipal;
    /**
     * 该期次已还总金额(单位：分)
     */
    private $periodPaidTotalAmount;
    /**
     * 该期次应还利息(单位：分)
     */
    private $periodPayableInterest;
    /**
     * 该期次应还罚息(单位：分，没有则为0)
     */
    private $periodPayablePenalty;
    /**
     * 该期次应还本金(单位：分)
     */
    private $periodPayablePrincipal;
    /**
     * 该期次应还总金额(单位：分)：应还本金+应还利息+应还罚息
     */
    private $periodPayableTotalAmount;
    /**
     * 本金逾期天数(没有则为0)
     */
    private $prinOvdDays;
    /**
     * 本次还款日期
     */
    private $repayRealDate;
    /**
     * 还款期数：如1=第1期
     */
    private $repaymentTerms;
    /**
     * 发送钉钉卡片消息：0 不发送，1 发送
     */
    private $sendDingDingMsg;
    /**
     * 手机号
     */
    private $userMobile;

    public function setCurrentUnpaidInterest($currentUnpaidInterest)
    {
        $this->currentUnpaidInterest = $currentUnpaidInterest;
        $this->apiParas['current_unpaid_interest'] = $currentUnpaidInterest;
    }

    public function getCurrentUnpaidInterest()
    {
        return $this->currentUnpaidInterest;
    }

    public function setCurrentUnpaidPenalty($currentUnpaidPenalty)
    {
        $this->currentUnpaidPenalty = $currentUnpaidPenalty;
        $this->apiParas['current_unpaid_penalty'] = $currentUnpaidPenalty;
    }

    public function getCurrentUnpaidPenalty()
    {
        return $this->currentUnpaidPenalty;
    }

    public function setCurrentUnpaidPrincipal($currentUnpaidPrincipal)
    {
        $this->currentUnpaidPrincipal = $currentUnpaidPrincipal;
        $this->apiParas['current_unpaid_principal'] = $currentUnpaidPrincipal;
    }

    public function getCurrentUnpaidPrincipal()
    {
        return $this->currentUnpaidPrincipal;
    }

    public function setCurrentUnpaidTotalAmount($currentUnpaidTotalAmount)
    {
        $this->currentUnpaidTotalAmount = $currentUnpaidTotalAmount;
        $this->apiParas['current_unpaid_total_amount'] = $currentUnpaidTotalAmount;
    }

    public function getCurrentUnpaidTotalAmount()
    {
        return $this->currentUnpaidTotalAmount;
    }

    public function setIdCardNo($idCardNo)
    {
        $this->idCardNo = $idCardNo;
        $this->apiParas['id_card_no'] = $idCardNo;
    }

    public function getIdCardNo()
    {
        return $this->idCardNo;
    }

    public function setIntOvdDays($intOvdDays)
    {
        $this->intOvdDays = $intOvdDays;
        $this->apiParas['int_ovd_days'] = $intOvdDays;
    }

    public function getIntOvdDays()
    {
        return $this->intOvdDays;
    }

    public function setLoanOrderNo($loanOrderNo)
    {
        $this->loanOrderNo = $loanOrderNo;
        $this->apiParas['loan_order_no'] = $loanOrderNo;
    }

    public function getLoanOrderNo()
    {
        return $this->loanOrderNo;
    }

    public function setOpenChannelName($openChannelName)
    {
        $this->openChannelName = $openChannelName;
        $this->apiParas['open_channel_name'] = $openChannelName;
    }

    public function getOpenChannelName()
    {
        return $this->openChannelName;
    }

    public function setOpenProductName($openProductName)
    {
        $this->openProductName = $openProductName;
        $this->apiParas['open_product_name'] = $openProductName;
    }

    public function getOpenProductName()
    {
        return $this->openProductName;
    }

    public function setOvdTerms($ovdTerms)
    {
        $this->ovdTerms = $ovdTerms;
        $this->apiParas['ovd_terms'] = $ovdTerms;
    }

    public function getOvdTerms()
    {
        return $this->ovdTerms;
    }

    public function setPaidInterest($paidInterest)
    {
        $this->paidInterest = $paidInterest;
        $this->apiParas['paid_interest'] = $paidInterest;
    }

    public function getPaidInterest()
    {
        return $this->paidInterest;
    }

    public function setPaidPenalty($paidPenalty)
    {
        $this->paidPenalty = $paidPenalty;
        $this->apiParas['paid_penalty'] = $paidPenalty;
    }

    public function getPaidPenalty()
    {
        return $this->paidPenalty;
    }

    public function setPaidPrincipal($paidPrincipal)
    {
        $this->paidPrincipal = $paidPrincipal;
        $this->apiParas['paid_principal'] = $paidPrincipal;
    }

    public function getPaidPrincipal()
    {
        return $this->paidPrincipal;
    }

    public function setPaidTotalAmount($paidTotalAmount)
    {
        $this->paidTotalAmount = $paidTotalAmount;
        $this->apiParas['paid_total_amount'] = $paidTotalAmount;
    }

    public function getPaidTotalAmount()
    {
        return $this->paidTotalAmount;
    }

    public function setPayableInterest($payableInterest)
    {
        $this->payableInterest = $payableInterest;
        $this->apiParas['payable_interest'] = $payableInterest;
    }

    public function getPayableInterest()
    {
        return $this->payableInterest;
    }

    public function setPayablePenalty($payablePenalty)
    {
        $this->payablePenalty = $payablePenalty;
        $this->apiParas['payable_penalty'] = $payablePenalty;
    }

    public function getPayablePenalty()
    {
        return $this->payablePenalty;
    }

    public function setPayablePrincipal($payablePrincipal)
    {
        $this->payablePrincipal = $payablePrincipal;
        $this->apiParas['payable_principal'] = $payablePrincipal;
    }

    public function getPayablePrincipal()
    {
        return $this->payablePrincipal;
    }

    public function setPayableTotalAmount($payableTotalAmount)
    {
        $this->payableTotalAmount = $payableTotalAmount;
        $this->apiParas['payable_total_amount'] = $payableTotalAmount;
    }

    public function getPayableTotalAmount()
    {
        return $this->payableTotalAmount;
    }

    public function setPeriodPaidInterest($periodPaidInterest)
    {
        $this->periodPaidInterest = $periodPaidInterest;
        $this->apiParas['period_paid_interest'] = $periodPaidInterest;
    }

    public function getPeriodPaidInterest()
    {
        return $this->periodPaidInterest;
    }

    public function setPeriodPaidPenalty($periodPaidPenalty)
    {
        $this->periodPaidPenalty = $periodPaidPenalty;
        $this->apiParas['period_paid_penalty'] = $periodPaidPenalty;
    }

    public function getPeriodPaidPenalty()
    {
        return $this->periodPaidPenalty;
    }

    public function setPeriodPaidPrincipal($periodPaidPrincipal)
    {
        $this->periodPaidPrincipal = $periodPaidPrincipal;
        $this->apiParas['period_paid_principal'] = $periodPaidPrincipal;
    }

    public function getPeriodPaidPrincipal()
    {
        return $this->periodPaidPrincipal;
    }

    public function setPeriodPaidTotalAmount($periodPaidTotalAmount)
    {
        $this->periodPaidTotalAmount = $periodPaidTotalAmount;
        $this->apiParas['period_paid_total_amount'] = $periodPaidTotalAmount;
    }

    public function getPeriodPaidTotalAmount()
    {
        return $this->periodPaidTotalAmount;
    }

    public function setPeriodPayableInterest($periodPayableInterest)
    {
        $this->periodPayableInterest = $periodPayableInterest;
        $this->apiParas['period_payable_interest'] = $periodPayableInterest;
    }

    public function getPeriodPayableInterest()
    {
        return $this->periodPayableInterest;
    }

    public function setPeriodPayablePenalty($periodPayablePenalty)
    {
        $this->periodPayablePenalty = $periodPayablePenalty;
        $this->apiParas['period_payable_penalty'] = $periodPayablePenalty;
    }

    public function getPeriodPayablePenalty()
    {
        return $this->periodPayablePenalty;
    }

    public function setPeriodPayablePrincipal($periodPayablePrincipal)
    {
        $this->periodPayablePrincipal = $periodPayablePrincipal;
        $this->apiParas['period_payable_principal'] = $periodPayablePrincipal;
    }

    public function getPeriodPayablePrincipal()
    {
        return $this->periodPayablePrincipal;
    }

    public function setPeriodPayableTotalAmount($periodPayableTotalAmount)
    {
        $this->periodPayableTotalAmount = $periodPayableTotalAmount;
        $this->apiParas['period_payable_total_amount'] = $periodPayableTotalAmount;
    }

    public function getPeriodPayableTotalAmount()
    {
        return $this->periodPayableTotalAmount;
    }

    public function setPrinOvdDays($prinOvdDays)
    {
        $this->prinOvdDays = $prinOvdDays;
        $this->apiParas['prin_ovd_days'] = $prinOvdDays;
    }

    public function getPrinOvdDays()
    {
        return $this->prinOvdDays;
    }

    public function setRepayRealDate($repayRealDate)
    {
        $this->repayRealDate = $repayRealDate;
        $this->apiParas['repay_real_date'] = $repayRealDate;
    }

    public function getRepayRealDate()
    {
        return $this->repayRealDate;
    }

    public function setRepaymentTerms($repaymentTerms)
    {
        $this->repaymentTerms = $repaymentTerms;
        $this->apiParas['repayment_terms'] = $repaymentTerms;
    }

    public function getRepaymentTerms()
    {
        return $this->repaymentTerms;
    }

    public function setSendDingDingMsg($sendDingDingMsg)
    {
        $this->sendDingDingMsg = $sendDingDingMsg;
        $this->apiParas['send_ding_ding_msg'] = $sendDingDingMsg;
    }

    public function getSendDingDingMsg()
    {
        return $this->sendDingDingMsg;
    }

    public function setUserMobile($userMobile)
    {
        $this->userMobile = $userMobile;
        $this->apiParas['user_mobile'] = $userMobile;
    }

    public function getUserMobile()
    {
        return $this->userMobile;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.finance.loan.notify.repayment.overdue';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->currentUnpaidInterest, 'currentUnpaidInterest');
        RequestCheckUtil::checkNotNull($this->currentUnpaidPenalty, 'currentUnpaidPenalty');
        RequestCheckUtil::checkNotNull($this->currentUnpaidPrincipal, 'currentUnpaidPrincipal');
        RequestCheckUtil::checkNotNull($this->currentUnpaidTotalAmount, 'currentUnpaidTotalAmount');
        RequestCheckUtil::checkNotNull($this->idCardNo, 'idCardNo');
        RequestCheckUtil::checkNotNull($this->intOvdDays, 'intOvdDays');
        RequestCheckUtil::checkNotNull($this->loanOrderNo, 'loanOrderNo');
        RequestCheckUtil::checkNotNull($this->openChannelName, 'openChannelName');
        RequestCheckUtil::checkNotNull($this->openProductName, 'openProductName');
        RequestCheckUtil::checkNotNull($this->ovdTerms, 'ovdTerms');
        RequestCheckUtil::checkNotNull($this->paidInterest, 'paidInterest');
        RequestCheckUtil::checkNotNull($this->paidPenalty, 'paidPenalty');
        RequestCheckUtil::checkNotNull($this->paidPrincipal, 'paidPrincipal');
        RequestCheckUtil::checkNotNull($this->paidTotalAmount, 'paidTotalAmount');
        RequestCheckUtil::checkNotNull($this->payableInterest, 'payableInterest');
        RequestCheckUtil::checkNotNull($this->payablePenalty, 'payablePenalty');
        RequestCheckUtil::checkNotNull($this->payablePrincipal, 'payablePrincipal');
        RequestCheckUtil::checkNotNull($this->payableTotalAmount, 'payableTotalAmount');
        RequestCheckUtil::checkNotNull($this->periodPaidInterest, 'periodPaidInterest');
        RequestCheckUtil::checkNotNull($this->periodPaidPenalty, 'periodPaidPenalty');
        RequestCheckUtil::checkNotNull($this->periodPaidPrincipal, 'periodPaidPrincipal');
        RequestCheckUtil::checkNotNull($this->periodPaidTotalAmount, 'periodPaidTotalAmount');
        RequestCheckUtil::checkNotNull($this->periodPayableInterest, 'periodPayableInterest');
        RequestCheckUtil::checkNotNull($this->periodPayablePenalty, 'periodPayablePenalty');
        RequestCheckUtil::checkNotNull($this->periodPayablePrincipal, 'periodPayablePrincipal');
        RequestCheckUtil::checkNotNull($this->periodPayableTotalAmount, 'periodPayableTotalAmount');
        RequestCheckUtil::checkNotNull($this->prinOvdDays, 'prinOvdDays');
        RequestCheckUtil::checkNotNull($this->repayRealDate, 'repayRealDate');
        RequestCheckUtil::checkNotNull($this->repaymentTerms, 'repaymentTerms');
        RequestCheckUtil::checkNotNull($this->sendDingDingMsg, 'sendDingDingMsg');
        RequestCheckUtil::checkNotNull($this->userMobile, 'userMobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
