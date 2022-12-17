<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.loan.notify.credit request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.25
 */
class LoanNotifyCreditRequest extends BaseRequest
{
    /**
     * 授信额度(单位：分)，授信成功必需
     */
    private $amount;
    /**
     * 可用授信额度
     */
    private $availableAmount;
    /**
     * 授信金额变化值： 等于0(默认) 不变，大于0 增加，小于0 减少
     */
    private $changeAmount;
    /**
     * 授信完成时间
     */
    private $completeTime;
    /**
     * 授信编号
     */
    private $creditNo;
    /**
     * 授信类型：null或0(默认) 授信额度无变化，1 授信额度有变化，变化值见changeAmount
     */
    private $creditType;
    /**
     * 日利率(精确4位小数，百分之*)，样例：0.0125
     */
    private $dailyInterestRate;
    /**
     * 扩展信息
     */
    private $extension;
    /**
     * 身份证号
     */
    private $idCardNo;
    /**
     * 下一次申请日期
     */
    private $nextApplyDay;
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
     * 拒绝原因错误码，授信失败必需
     */
    private $refuseCode;
    /**
     * 拒绝原因，授信失败必需
     */
    private $refuseReason;
    /**
     * 授信结果：0 未提交，1 授信申请中，2 授信成功/审批通过，3 授信失败/审批拒绝
     */
    private $status;
    /**
     * 授信提交/申请时间
     */
    private $submitTime;
    /**
     * 手机号
     */
    private $userMobile;
    /**
     * 年利率(精确2位小数，百分之*)，样例：5.45
     */
    private $yearInterestRate;

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

    public function setChangeAmount($changeAmount)
    {
        $this->changeAmount = $changeAmount;
        $this->apiParas['change_amount'] = $changeAmount;
    }

    public function getChangeAmount()
    {
        return $this->changeAmount;
    }

    public function setCompleteTime($completeTime)
    {
        $this->completeTime = $completeTime;
        $this->apiParas['complete_time'] = $completeTime;
    }

    public function getCompleteTime()
    {
        return $this->completeTime;
    }

    public function setCreditNo($creditNo)
    {
        $this->creditNo = $creditNo;
        $this->apiParas['credit_no'] = $creditNo;
    }

    public function getCreditNo()
    {
        return $this->creditNo;
    }

    public function setCreditType($creditType)
    {
        $this->creditType = $creditType;
        $this->apiParas['credit_type'] = $creditType;
    }

    public function getCreditType()
    {
        return $this->creditType;
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

    public function setExtension($extension)
    {
        $this->extension = $extension;
        $this->apiParas['extension'] = $extension;
    }

    public function getExtension()
    {
        return $this->extension;
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

    public function setNextApplyDay($nextApplyDay)
    {
        $this->nextApplyDay = $nextApplyDay;
        $this->apiParas['next_apply_day'] = $nextApplyDay;
    }

    public function getNextApplyDay()
    {
        return $this->nextApplyDay;
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

    public function setRefuseCode($refuseCode)
    {
        $this->refuseCode = $refuseCode;
        $this->apiParas['refuse_code'] = $refuseCode;
    }

    public function getRefuseCode()
    {
        return $this->refuseCode;
    }

    public function setRefuseReason($refuseReason)
    {
        $this->refuseReason = $refuseReason;
        $this->apiParas['refuse_reason'] = $refuseReason;
    }

    public function getRefuseReason()
    {
        return $this->refuseReason;
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

    public function setSubmitTime($submitTime)
    {
        $this->submitTime = $submitTime;
        $this->apiParas['submit_time'] = $submitTime;
    }

    public function getSubmitTime()
    {
        return $this->submitTime;
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

    public function setYearInterestRate($yearInterestRate)
    {
        $this->yearInterestRate = $yearInterestRate;
        $this->apiParas['year_interest_rate'] = $yearInterestRate;
    }

    public function getYearInterestRate()
    {
        return $this->yearInterestRate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.finance.loan.notify.credit';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->amount, 'amount');
        RequestCheckUtil::checkNotNull($this->availableAmount, 'availableAmount');
        RequestCheckUtil::checkNotNull($this->changeAmount, 'changeAmount');
        RequestCheckUtil::checkNotNull($this->completeTime, 'completeTime');
        RequestCheckUtil::checkNotNull($this->creditNo, 'creditNo');
        RequestCheckUtil::checkNotNull($this->creditType, 'creditType');
        RequestCheckUtil::checkNotNull($this->dailyInterestRate, 'dailyInterestRate');
        RequestCheckUtil::checkNotNull($this->idCardNo, 'idCardNo');
        RequestCheckUtil::checkNotNull($this->nextApplyDay, 'nextApplyDay');
        RequestCheckUtil::checkNotNull($this->openChannelName, 'openChannelName');
        RequestCheckUtil::checkNotNull($this->openProductCode, 'openProductCode');
        RequestCheckUtil::checkNotNull($this->openProductName, 'openProductName');
        RequestCheckUtil::checkNotNull($this->openProductType, 'openProductType');
        RequestCheckUtil::checkNotNull($this->refuseCode, 'refuseCode');
        RequestCheckUtil::checkNotNull($this->refuseReason, 'refuseReason');
        RequestCheckUtil::checkNotNull($this->status, 'status');
        RequestCheckUtil::checkNotNull($this->submitTime, 'submitTime');
        RequestCheckUtil::checkNotNull($this->userMobile, 'userMobile');
        RequestCheckUtil::checkNotNull($this->yearInterestRate, 'yearInterestRate');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
