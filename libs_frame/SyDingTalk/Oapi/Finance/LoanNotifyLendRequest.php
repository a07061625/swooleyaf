<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.loan.notify.lend request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.25
 */
class LoanNotifyLendRequest extends BaseRequest
{
    /**
     * 借据更新时间(影响授信/可用额度等金额变化)
     */
    private $amountUpdateTime;
    /**
     * 剩余可用/可借额度(单位：分)
     */
    private $availableLimit;
    /**
     * 收款银行名称
     */
    private $bankName;
    /**
     * 收款银行卡号
     */
    private $bankcardNo;
    /**
     * 每月账单日，如每月3号
     */
    private $billDate;
    /**
     * 账单分期期次信息，借款失败时传空数组
     */
    private $billInfoList;
    /**
     * 授信总额度
     */
    private $creditAmount;
    /**
     * 日利率(精确4位小数，百分之*)
     */
    private $dailyInterestRate;
    /**
     * 优惠券id：不存在传0，多个使用,分隔
     */
    private $discountsId;
    /**
     * 放款失败原因：失败时值不能为空（尽可能详细）
     */
    private $failReason;
    /**
     * 支用时失败原因，失败时必传
     */
    private $failReasonToUser;
    /**
     * 首期账单日：与每月账单日相同可不传
     */
    private $firstBillDate;
    /**
     * 首期还款日：与每月还款日相同可不传
     */
    private $firstRepayDate;
    /**
     * 身份证号
     */
    private $idCardNo;
    /**
     * 最后还款日
     */
    private $lastRepayDate;
    /**
     * 借款/支用金额(单位：分)
     */
    private $loanAmount;
    /**
     * 借据生效时间（成功）：用户支用金额申请/提交后，行方审核完成时间
     */
    private $loanEffectiveTime;
    /**
     * 结清日期：最后一期(逾期)还款成功完成/结束时间
     */
    private $loanEndTime;
    /**
     * 借据流水号：没有传0
     */
    private $loanOrderFlowNo;
    /**
     * 借据编号
     */
    private $loanOrderNo;
    /**
     * 分期申请提交时间：用户支用金额申请/提交时间
     */
    private $loanSubmitTime;
    /**
     * 入账成功(打款到用户银行卡)时间：用户支用金额申请/提交后&行方审核通过后向用户银行卡打款时间
     */
    private $loanTxnTime;
    /**
     * 借款用途
     */
    private $loanUsage;
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
     * 借据已还利息(单位：分)
     */
    private $paidInterest;
    /**
     * 借据已还罚息(单位：分，没有则为0)=本金罚息+利息罚息
     */
    private $paidPenalty;
    /**
     * 借据已还本金(单位：分)
     */
    private $paidPrincipal;
    /**
     * 借据已还总金额(单位：分)：已还本金+已还利息+已还罚息
     */
    private $paidTotalAmount;
    /**
     * 应还利息(单位：分)
     */
    private $payableInterest;
    /**
     * 借据应还罚息(单位：分，没有则为0)=本金罚息+利息罚息
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
     * 优惠券减免金额(单位：分)：不存在传0
     */
    private $reductionTotalAmount;
    /**
     * 每月还款日，如每月5号
     */
    private $repayDate;
    /**
     * 还款方式：RMT00 等额本息，RMT01 先息后本
     */
    private $repayType;
    /**
     * 状态：APPLYING 支用申请中，CREDIT_SUCCESS 审核通过，CREDIT_FAILED 审核不通过/借款申请失败，USE_SUCCESS 支用成功：打款到用户银行卡成功，USE_FAILED 支用失败，NORMAL 还款中，OVERDUE 逾期，CLEAR 结清，WRITEOFF 核销
     */
    private $status;
    /**
     * 分期总期数
     */
    private $totalTerm;
    /**
     * 手机号
     */
    private $userMobile;
    /**
     * 年利率(精确2位小数，百分之*)
     */
    private $yearLoanInterestRate;

    public function setAmountUpdateTime($amountUpdateTime)
    {
        $this->amountUpdateTime = $amountUpdateTime;
        $this->apiParas['amount_update_time'] = $amountUpdateTime;
    }

    public function getAmountUpdateTime()
    {
        return $this->amountUpdateTime;
    }

    public function setAvailableLimit($availableLimit)
    {
        $this->availableLimit = $availableLimit;
        $this->apiParas['available_limit'] = $availableLimit;
    }

    public function getAvailableLimit()
    {
        return $this->availableLimit;
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

    public function setBillDate($billDate)
    {
        $this->billDate = $billDate;
        $this->apiParas['bill_date'] = $billDate;
    }

    public function getBillDate()
    {
        return $this->billDate;
    }

    public function setBillInfoList($billInfoList)
    {
        $this->billInfoList = $billInfoList;
        $this->apiParas['bill_info_list'] = $billInfoList;
    }

    public function getBillInfoList()
    {
        return $this->billInfoList;
    }

    public function setCreditAmount($creditAmount)
    {
        $this->creditAmount = $creditAmount;
        $this->apiParas['credit_amount'] = $creditAmount;
    }

    public function getCreditAmount()
    {
        return $this->creditAmount;
    }

    public function setDailyInterestRate($dailyInterestRate)
    {
        $this->dailyInterestRate = $dailyInterestRate;
        $this->apiParas['daily_interest_rate'] = $dailyInterestRate;
    }

    public function getDailyInterestRate()
    {
        return $this->dailyInterestRate;
    }

    public function setDiscountsId($discountsId)
    {
        $this->discountsId = $discountsId;
        $this->apiParas['discounts_id'] = $discountsId;
    }

    public function getDiscountsId()
    {
        return $this->discountsId;
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

    public function setFirstBillDate($firstBillDate)
    {
        $this->firstBillDate = $firstBillDate;
        $this->apiParas['first_bill_date'] = $firstBillDate;
    }

    public function getFirstBillDate()
    {
        return $this->firstBillDate;
    }

    public function setFirstRepayDate($firstRepayDate)
    {
        $this->firstRepayDate = $firstRepayDate;
        $this->apiParas['first_repay_date'] = $firstRepayDate;
    }

    public function getFirstRepayDate()
    {
        return $this->firstRepayDate;
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

    public function setLastRepayDate($lastRepayDate)
    {
        $this->lastRepayDate = $lastRepayDate;
        $this->apiParas['last_repay_date'] = $lastRepayDate;
    }

    public function getLastRepayDate()
    {
        return $this->lastRepayDate;
    }

    public function setLoanAmount($loanAmount)
    {
        $this->loanAmount = $loanAmount;
        $this->apiParas['loan_amount'] = $loanAmount;
    }

    public function getLoanAmount()
    {
        return $this->loanAmount;
    }

    public function setLoanEffectiveTime($loanEffectiveTime)
    {
        $this->loanEffectiveTime = $loanEffectiveTime;
        $this->apiParas['loan_effective_time'] = $loanEffectiveTime;
    }

    public function getLoanEffectiveTime()
    {
        return $this->loanEffectiveTime;
    }

    public function setLoanEndTime($loanEndTime)
    {
        $this->loanEndTime = $loanEndTime;
        $this->apiParas['loan_end_time'] = $loanEndTime;
    }

    public function getLoanEndTime()
    {
        return $this->loanEndTime;
    }

    public function setLoanOrderFlowNo($loanOrderFlowNo)
    {
        $this->loanOrderFlowNo = $loanOrderFlowNo;
        $this->apiParas['loan_order_flow_no'] = $loanOrderFlowNo;
    }

    public function getLoanOrderFlowNo()
    {
        return $this->loanOrderFlowNo;
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

    public function setLoanSubmitTime($loanSubmitTime)
    {
        $this->loanSubmitTime = $loanSubmitTime;
        $this->apiParas['loan_submit_time'] = $loanSubmitTime;
    }

    public function getLoanSubmitTime()
    {
        return $this->loanSubmitTime;
    }

    public function setLoanTxnTime($loanTxnTime)
    {
        $this->loanTxnTime = $loanTxnTime;
        $this->apiParas['loan_txn_time'] = $loanTxnTime;
    }

    public function getLoanTxnTime()
    {
        return $this->loanTxnTime;
    }

    public function setLoanUsage($loanUsage)
    {
        $this->loanUsage = $loanUsage;
        $this->apiParas['loan_usage'] = $loanUsage;
    }

    public function getLoanUsage()
    {
        return $this->loanUsage;
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

    public function setReductionTotalAmount($reductionTotalAmount)
    {
        $this->reductionTotalAmount = $reductionTotalAmount;
        $this->apiParas['reduction_total_amount'] = $reductionTotalAmount;
    }

    public function getReductionTotalAmount()
    {
        return $this->reductionTotalAmount;
    }

    public function setRepayDate($repayDate)
    {
        $this->repayDate = $repayDate;
        $this->apiParas['repay_date'] = $repayDate;
    }

    public function getRepayDate()
    {
        return $this->repayDate;
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

    public function setStatus($status)
    {
        $this->status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setTotalTerm($totalTerm)
    {
        $this->totalTerm = $totalTerm;
        $this->apiParas['total_term'] = $totalTerm;
    }

    public function getTotalTerm()
    {
        return $this->totalTerm;
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

    public function setYearLoanInterestRate($yearLoanInterestRate)
    {
        $this->yearLoanInterestRate = $yearLoanInterestRate;
        $this->apiParas['year_loan_interest_rate'] = $yearLoanInterestRate;
    }

    public function getYearLoanInterestRate()
    {
        return $this->yearLoanInterestRate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.finance.loan.notify.lend';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->amountUpdateTime, 'amountUpdateTime');
        RequestCheckUtil::checkNotNull($this->availableLimit, 'availableLimit');
        RequestCheckUtil::checkNotNull($this->bankName, 'bankName');
        RequestCheckUtil::checkNotNull($this->bankcardNo, 'bankcardNo');
        RequestCheckUtil::checkNotNull($this->billDate, 'billDate');
        RequestCheckUtil::checkNotNull($this->creditAmount, 'creditAmount');
        RequestCheckUtil::checkNotNull($this->dailyInterestRate, 'dailyInterestRate');
        RequestCheckUtil::checkNotNull($this->discountsId, 'discountsId');
        RequestCheckUtil::checkNotNull($this->failReason, 'failReason');
        RequestCheckUtil::checkNotNull($this->failReasonToUser, 'failReasonToUser');
        RequestCheckUtil::checkNotNull($this->firstBillDate, 'firstBillDate');
        RequestCheckUtil::checkNotNull($this->firstRepayDate, 'firstRepayDate');
        RequestCheckUtil::checkNotNull($this->idCardNo, 'idCardNo');
        RequestCheckUtil::checkNotNull($this->lastRepayDate, 'lastRepayDate');
        RequestCheckUtil::checkNotNull($this->loanAmount, 'loanAmount');
        RequestCheckUtil::checkNotNull($this->loanEffectiveTime, 'loanEffectiveTime');
        RequestCheckUtil::checkNotNull($this->loanEndTime, 'loanEndTime');
        RequestCheckUtil::checkNotNull($this->loanOrderFlowNo, 'loanOrderFlowNo');
        RequestCheckUtil::checkNotNull($this->loanOrderNo, 'loanOrderNo');
        RequestCheckUtil::checkNotNull($this->loanSubmitTime, 'loanSubmitTime');
        RequestCheckUtil::checkNotNull($this->loanTxnTime, 'loanTxnTime');
        RequestCheckUtil::checkNotNull($this->loanUsage, 'loanUsage');
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
        RequestCheckUtil::checkNotNull($this->reductionTotalAmount, 'reductionTotalAmount');
        RequestCheckUtil::checkNotNull($this->repayDate, 'repayDate');
        RequestCheckUtil::checkNotNull($this->repayType, 'repayType');
        RequestCheckUtil::checkNotNull($this->status, 'status');
        RequestCheckUtil::checkNotNull($this->totalTerm, 'totalTerm');
        RequestCheckUtil::checkNotNull($this->userMobile, 'userMobile');
        RequestCheckUtil::checkNotNull($this->yearLoanInterestRate, 'yearLoanInterestRate');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
