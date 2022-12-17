<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.loan.notify.repayment.notice request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.20
 */
class LoanNotifyRepaymentNoticeRequest extends BaseRequest
{
    /**
     * 身份证号
     */
    private $idCardNo;
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
     * 本次还款时逾期期数(不包括已经还逾期的，没有则为0)：如1,2=第1期+第2期都逾期
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
     * 本次还款日期
     */
    private $repayRealDate;
    /**
     * 还款期数：如1=第1期
     */
    private $repaymentTerms;
    /**
     * 手机号
     */
    private $userMobile;

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
        return 'dingtalk.oapi.finance.loan.notify.repayment.notice';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->idCardNo, 'idCardNo');
        RequestCheckUtil::checkNotNull($this->loanOrderNo, 'loanOrderNo');
        RequestCheckUtil::checkNotNull($this->openChannelName, 'openChannelName');
        RequestCheckUtil::checkNotNull($this->openProductName, 'openProductName');
        RequestCheckUtil::checkNotNull($this->ovdTerms, 'ovdTerms');
        RequestCheckUtil::checkNotNull($this->paidInterest, 'paidInterest');
        RequestCheckUtil::checkNotNull($this->paidPenalty, 'paidPenalty');
        RequestCheckUtil::checkNotNull($this->paidPrincipal, 'paidPrincipal');
        RequestCheckUtil::checkNotNull($this->paidTotalAmount, 'paidTotalAmount');
        RequestCheckUtil::checkNotNull($this->repayRealDate, 'repayRealDate');
        RequestCheckUtil::checkNotNull($this->repaymentTerms, 'repaymentTerms');
        RequestCheckUtil::checkNotNull($this->userMobile, 'userMobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
