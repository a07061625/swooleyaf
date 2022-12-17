<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.loan.notify.repayment request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.05
 */
class LoanNotifyRepaymentRequest extends BaseRequest
{
    /**
     * 授信额度(单位：分)，授信成功必需
     */
    private $amount;
    /**
     * 可用授信额度：等于授信总额度减去已经借款总额度
     */
    private $availableAmount;
    /**
     * 还款银行名称
     */
    private $bankName;
    /**
     * 还款银行卡号
     */
    private $bankcardNo;
    /**
     * 本次还款时利息逾期天数(不包括已经还逾期的，没有则为0)：多笔分期还款逾期，求各逾期天数总和；如：1期逾期35天，第2期逾期4天，总逾期39天
     */
    private $currentIntOvdDays;
    /**
     * 本次还款时逾期期次(不包括已经还的逾期，没有则为0)：如1,2=第1期+第2期都逾期
     */
    private $currentOvdTerms;
    /**
     * 本次已还利息(单位：分)
     */
    private $currentPaidInterest;
    /**
     * 本次已还罚息(单位：分，精确2位小数，没有则为0)=本次本金罚息+本次利息罚息
     */
    private $currentPaidPenalty;
    /**
     * 本次已还本金(单位：分)
     */
    private $currentPaidPrincipal;
    /**
     * 本次已还总金额(单位：分)：已还本金+已还利息+已还罚息
     */
    private $currentPaidTotalAmount;
    /**
     * 本次还款时本金逾期天数(不包括已经还逾期的，没有则为0)：多笔分期还款逾期，求各逾期天数总和；如：1期逾期35天，第2期逾期4天，总逾期39天
     */
    private $currentPrinOvdDays;
    /**
     * 还款结果信息：失败原因等
     */
    private $failReason;
    /**
     * 还款失败原因(还款失败必传)：用户发送钉钉卡片消息
     */
    private $failReasonToUser;
    /**
     * 身份证号
     */
    private $idCardNo;
    /**
     * 借据编号
     */
    private $loanOrderNo;
    /**
     * 渠道方名称
     */
    private $openChannelName;
    /**
     * 渠道方产品码
     */
    private $openProductCode;
    /**
     * 渠道方产品名称
     */
    private $openProductName;
    /**
     * 渠道方产品类型
     */
    private $openProductType;
    /**
     * 已还利息(单位：分)
     */
    private $paidInterest;
    /**
     * 已还罚息(单位：分，没有则为0)=本金罚息+利息罚息
     */
    private $paidPenalty;
    /**
     * 已还本金(单位：分)
     */
    private $paidPrincipal;
    /**
     * 已还总金额(单位：分)：已还本金+已还利息+已还罚息
     */
    private $paidTotalAmount;
    /**
     * 应还利息(单位：分)
     */
    private $payableInterest;
    /**
     * 应还罚息(单位：分，没有则为0)=本金罚息+利息罚息
     */
    private $payablePenalty;
    /**
     * 应还本金(单位：分)
     */
    private $payablePrincipal;
    /**
     * 应还总金额(单位：分)：应还本金+应还利息+应还罚息
     */
    private $payableTotalAmount;
    /**
     * 该期次是否已经全部还清：0 没有还清，1 全部还清
     */
    private $periodPaidAll;
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
     * 还款时间
     */
    private $repayRealDate;
    /**
     * 还款方式：RMT00 等额本息，RMT01 先息后本
     */
    private $repayType;
    /**
     * 还款编号：当前渠道唯一，用于处理重复通知问题
     */
    private $repaymentNo;
    /**
     * 还款期次：1=第1期
     */
    private $repaymentTerms;
    /**
     * 还款状态：SUCCESS=成功、FAIL=失败、PING=还款中
     */
    private $status;
    /**
     * 还款类型：SYSTERM=系统代扣、ONTIME=按期还款、ADVANCE=提前还款、OVERDUE=逾期还款
     */
    private $type;
    /**
     * 手机号
     */
    private $userMobile;

    public function setAmount($amount)
    {
        $this->amount = $amount;
        $this->apiParas['amount'] = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAvailableAmount($availableAmount)
    {
        $this->availableAmount = $availableAmount;
        $this->apiParas['available_amount'] = $availableAmount;
    }

    public function getAvailableAmount()
    {
        return $this->availableAmount;
    }

    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
        $this->apiParas['bank_name'] = $bankName;
    }

    public function getBankName()
    {
        return $this->bankName;
    }

    public function setBankcardNo($bankcardNo)
    {
        $this->bankcardNo = $bankcardNo;
        $this->apiParas['bankcard_no'] = $bankcardNo;
    }

    public function getBankcardNo()
    {
        return $this->bankcardNo;
    }

    public function setCurrentIntOvdDays($currentIntOvdDays)
    {
        $this->currentIntOvdDays = $currentIntOvdDays;
        $this->apiParas['current_int_ovd_days'] = $currentIntOvdDays;
    }

    public function getCurrentIntOvdDays()
    {
        return $this->currentIntOvdDays;
    }

    public function setCurrentOvdTerms($currentOvdTerms)
    {
        $this->currentOvdTerms = $currentOvdTerms;
        $this->apiParas['current_ovd_terms'] = $currentOvdTerms;
    }

    public function getCurrentOvdTerms()
    {
        return $this->currentOvdTerms;
    }

    public function setCurrentPaidInterest($currentPaidInterest)
    {
        $this->currentPaidInterest = $currentPaidInterest;
        $this->apiParas['current_paid_interest'] = $currentPaidInterest;
    }

    public function getCurrentPaidInterest()
    {
        return $this->currentPaidInterest;
    }

    public function setCurrentPaidPenalty($currentPaidPenalty)
    {
        $this->currentPaidPenalty = $currentPaidPenalty;
        $this->apiParas['current_paid_penalty'] = $currentPaidPenalty;
    }

    public function getCurrentPaidPenalty()
    {
        return $this->currentPaidPenalty;
    }

    public function setCurrentPaidPrincipal($currentPaidPrincipal)
    {
        $this->currentPaidPrincipal = $currentPaidPrincipal;
        $this->apiParas['current_paid_principal'] = $currentPaidPrincipal;
    }

    public function getCurrentPaidPrincipal()
    {
        return $this->currentPaidPrincipal;
    }

    public function setCurrentPaidTotalAmount($currentPaidTotalAmount)
    {
        $this->currentPaidTotalAmount = $currentPaidTotalAmount;
        $this->apiParas['current_paid_total_amount'] = $currentPaidTotalAmount;
    }

    public function getCurrentPaidTotalAmount()
    {
        return $this->currentPaidTotalAmount;
    }

    public function setCurrentPrinOvdDays($currentPrinOvdDays)
    {
        $this->currentPrinOvdDays = $currentPrinOvdDays;
        $this->apiParas['current_prin_ovd_days'] = $currentPrinOvdDays;
    }

    public function getCurrentPrinOvdDays()
    {
        return $this->currentPrinOvdDays;
    }

    public function setFailReason($failReason)
    {
        $this->failReason = $failReason;
        $this->apiParas['fail_reason'] = $failReason;
    }

    public function getFailReason()
    {
        return $this->failReason;
    }

    public function setFailReasonToUser($failReasonToUser)
    {
        $this->failReasonToUser = $failReasonToUser;
        $this->apiParas['fail_reason_to_user'] = $failReasonToUser;
    }

    public function getFailReasonToUser()
    {
        return $this->failReasonToUser;
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

    public function setOpenProductCode($openProductCode)
    {
        $this->openProductCode = $openProductCode;
        $this->apiParas['open_product_code'] = $openProductCode;
    }

    public function getOpenProductCode()
    {
        return $this->openProductCode;
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

    public function setOpenProductType($openProductType)
    {
        $this->openProductType = $openProductType;
        $this->apiParas['open_product_type'] = $openProductType;
    }

    public function getOpenProductType()
    {
        return $this->openProductType;
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

    public function setPeriodPaidAll($periodPaidAll)
    {
        $this->periodPaidAll = $periodPaidAll;
        $this->apiParas['period_paid_all'] = $periodPaidAll;
    }

    public function getPeriodPaidAll()
    {
        return $this->periodPaidAll;
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

    public function setRepayRealDate($repayRealDate)
    {
        $this->repayRealDate = $repayRealDate;
        $this->apiParas['repay_real_date'] = $repayRealDate;
    }

    public function getRepayRealDate()
    {
        return $this->repayRealDate;
    }

    public function setRepayType($repayType)
    {
        $this->repayType = $repayType;
        $this->apiParas['repay_type'] = $repayType;
    }

    public function getRepayType()
    {
        return $this->repayType;
    }

    public function setRepaymentNo($repaymentNo)
    {
        $this->repaymentNo = $repaymentNo;
        $this->apiParas['repayment_no'] = $repaymentNo;
    }

    public function getRepaymentNo()
    {
        return $this->repaymentNo;
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

    public function setStatus($status)
    {
        $this->status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
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
        return 'dingtalk.oapi.finance.loan.notify.repayment';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->amount, 'amount');
        RequestCheckUtil::checkNotNull($this->availableAmount, 'availableAmount');
        RequestCheckUtil::checkNotNull($this->bankName, 'bankName');
        RequestCheckUtil::checkNotNull($this->bankcardNo, 'bankcardNo');
        RequestCheckUtil::checkNotNull($this->currentIntOvdDays, 'currentIntOvdDays');
        RequestCheckUtil::checkNotNull($this->currentOvdTerms, 'currentOvdTerms');
        RequestCheckUtil::checkNotNull($this->currentPaidInterest, 'currentPaidInterest');
        RequestCheckUtil::checkNotNull($this->currentPaidPenalty, 'currentPaidPenalty');
        RequestCheckUtil::checkNotNull($this->currentPaidPrincipal, 'currentPaidPrincipal');
        RequestCheckUtil::checkNotNull($this->currentPaidTotalAmount, 'currentPaidTotalAmount');
        RequestCheckUtil::checkNotNull($this->currentPrinOvdDays, 'currentPrinOvdDays');
        RequestCheckUtil::checkNotNull($this->failReason, 'failReason');
        RequestCheckUtil::checkNotNull($this->failReasonToUser, 'failReasonToUser');
        RequestCheckUtil::checkNotNull($this->idCardNo, 'idCardNo');
        RequestCheckUtil::checkNotNull($this->loanOrderNo, 'loanOrderNo');
        RequestCheckUtil::checkNotNull($this->openChannelName, 'openChannelName');
        RequestCheckUtil::checkNotNull($this->openProductCode, 'openProductCode');
        RequestCheckUtil::checkNotNull($this->openProductName, 'openProductName');
        RequestCheckUtil::checkNotNull($this->openProductType, 'openProductType');
        RequestCheckUtil::checkNotNull($this->paidInterest, 'paidInterest');
        RequestCheckUtil::checkNotNull($this->paidPenalty, 'paidPenalty');
        RequestCheckUtil::checkNotNull($this->paidPrincipal, 'paidPrincipal');
        RequestCheckUtil::checkNotNull($this->paidTotalAmount, 'paidTotalAmount');
        RequestCheckUtil::checkNotNull($this->payableInterest, 'payableInterest');
        RequestCheckUtil::checkNotNull($this->payablePenalty, 'payablePenalty');
        RequestCheckUtil::checkNotNull($this->payablePrincipal, 'payablePrincipal');
        RequestCheckUtil::checkNotNull($this->payableTotalAmount, 'payableTotalAmount');
        RequestCheckUtil::checkNotNull($this->periodPaidAll, 'periodPaidAll');
        RequestCheckUtil::checkNotNull($this->periodPaidInterest, 'periodPaidInterest');
        RequestCheckUtil::checkNotNull($this->periodPaidPenalty, 'periodPaidPenalty');
        RequestCheckUtil::checkNotNull($this->periodPaidPrincipal, 'periodPaidPrincipal');
        RequestCheckUtil::checkNotNull($this->periodPaidTotalAmount, 'periodPaidTotalAmount');
        RequestCheckUtil::checkNotNull($this->periodPayableInterest, 'periodPayableInterest');
        RequestCheckUtil::checkNotNull($this->periodPayablePenalty, 'periodPayablePenalty');
        RequestCheckUtil::checkNotNull($this->periodPayablePrincipal, 'periodPayablePrincipal');
        RequestCheckUtil::checkNotNull($this->periodPayableTotalAmount, 'periodPayableTotalAmount');
        RequestCheckUtil::checkNotNull($this->repayRealDate, 'repayRealDate');
        RequestCheckUtil::checkNotNull($this->repayType, 'repayType');
        RequestCheckUtil::checkNotNull($this->repaymentNo, 'repaymentNo');
        RequestCheckUtil::checkNotNull($this->repaymentTerms, 'repaymentTerms');
        RequestCheckUtil::checkNotNull($this->status, 'status');
        RequestCheckUtil::checkNotNull($this->type, 'type');
        RequestCheckUtil::checkNotNull($this->userMobile, 'userMobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
