<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingpay.bill.batchquerycount request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class BillBatchQueryCountRequest extends BaseRequest
{
    /**
     * 申请支付者userid
     */
    private $applyPayOperatorUserid;
    /**
     * INCOME收入、EXPENSE支出
     */
    private $billCategory;
    /**
     * 业务代码
     */
    private $bizCode;
    /**
     * 创单者userid
     */
    private $createOperatorUserid;
    /**
     * 扩展属性
     */
    private $extension;
    /**
     * 申请付款开始时间
     */
    private $gmtApplyPayBeginTime;
    /**
     * 申请付款截止时间
     */
    private $gmtApplyPayEndTime;
    /**
     * 创单开始时间
     */
    private $gmtCreateBeginTime;
    /**
     * 创单截止时间
     */
    private $gmtCreateEndTime;
    /**
     * 完成付款开始时间
     */
    private $gmtPayBeginTime;
    /**
     * 完成付款截止时间
     */
    private $gmtPayEndTime;
    /**
     * 最大金额（单位：分）
     */
    private $maxAmount;
    /**
     * 最小金额（单位：分）
     */
    private $minAmount;
    /**
     * 支付渠道列表
     */
    private $payChannelList;
    /**
     * 支付渠道方付款者实际出资UID
     */
    private $payChannelPayerRealUid;
    /**
     * 收款者corpId或者userId
     */
    private $payeeId;
    /**
     * 收款者类型
     */
    private $payeeUserType;
    /**
     * 付款者corpId或者userId
     */
    private $payerId;
    /**
     * 付款者类型
     */
    private $payerUserType;
    /**
     * 收款人账户类型
     */
    private $receiptorTypeList;
    /**
     * 状态列表
     */
    private $statusList;
    /**
     * 中止支付原因
     */
    private $terminationReason;
    /**
     * 标题
     */
    private $title;

    public function setApplyPayOperatorUserid($applyPayOperatorUserid)
    {
        $this->applyPayOperatorUserid = $applyPayOperatorUserid;
        $this->apiParas['apply_pay_operator_userid'] = $applyPayOperatorUserid;
    }

    public function getApplyPayOperatorUserid()
    {
        return $this->applyPayOperatorUserid;
    }

    public function setBillCategory($billCategory)
    {
        $this->billCategory = $billCategory;
        $this->apiParas['bill_category'] = $billCategory;
    }

    public function getBillCategory()
    {
        return $this->billCategory;
    }

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setCreateOperatorUserid($createOperatorUserid)
    {
        $this->createOperatorUserid = $createOperatorUserid;
        $this->apiParas['create_operator_userid'] = $createOperatorUserid;
    }

    public function getCreateOperatorUserid()
    {
        return $this->createOperatorUserid;
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

    public function setGmtApplyPayBeginTime($gmtApplyPayBeginTime)
    {
        $this->gmtApplyPayBeginTime = $gmtApplyPayBeginTime;
        $this->apiParas['gmt_apply_pay_begin_time'] = $gmtApplyPayBeginTime;
    }

    public function getGmtApplyPayBeginTime()
    {
        return $this->gmtApplyPayBeginTime;
    }

    public function setGmtApplyPayEndTime($gmtApplyPayEndTime)
    {
        $this->gmtApplyPayEndTime = $gmtApplyPayEndTime;
        $this->apiParas['gmt_apply_pay_end_time'] = $gmtApplyPayEndTime;
    }

    public function getGmtApplyPayEndTime()
    {
        return $this->gmtApplyPayEndTime;
    }

    public function setGmtCreateBeginTime($gmtCreateBeginTime)
    {
        $this->gmtCreateBeginTime = $gmtCreateBeginTime;
        $this->apiParas['gmt_create_begin_time'] = $gmtCreateBeginTime;
    }

    public function getGmtCreateBeginTime()
    {
        return $this->gmtCreateBeginTime;
    }

    public function setGmtCreateEndTime($gmtCreateEndTime)
    {
        $this->gmtCreateEndTime = $gmtCreateEndTime;
        $this->apiParas['gmt_create_end_time'] = $gmtCreateEndTime;
    }

    public function getGmtCreateEndTime()
    {
        return $this->gmtCreateEndTime;
    }

    public function setGmtPayBeginTime($gmtPayBeginTime)
    {
        $this->gmtPayBeginTime = $gmtPayBeginTime;
        $this->apiParas['gmt_pay_begin_time'] = $gmtPayBeginTime;
    }

    public function getGmtPayBeginTime()
    {
        return $this->gmtPayBeginTime;
    }

    public function setGmtPayEndTime($gmtPayEndTime)
    {
        $this->gmtPayEndTime = $gmtPayEndTime;
        $this->apiParas['gmt_pay_end_time'] = $gmtPayEndTime;
    }

    public function getGmtPayEndTime()
    {
        return $this->gmtPayEndTime;
    }

    public function setMaxAmount($maxAmount)
    {
        $this->maxAmount = $maxAmount;
        $this->apiParas['max_amount'] = $maxAmount;
    }

    public function getMaxAmount()
    {
        return $this->maxAmount;
    }

    public function setMinAmount($minAmount)
    {
        $this->minAmount = $minAmount;
        $this->apiParas['min_amount'] = $minAmount;
    }

    public function getMinAmount()
    {
        return $this->minAmount;
    }

    public function setPayChannelList($payChannelList)
    {
        $this->payChannelList = $payChannelList;
        $this->apiParas['pay_channel_list'] = $payChannelList;
    }

    public function getPayChannelList()
    {
        return $this->payChannelList;
    }

    public function setPayChannelPayerRealUid($payChannelPayerRealUid)
    {
        $this->payChannelPayerRealUid = $payChannelPayerRealUid;
        $this->apiParas['pay_channel_payer_real_uid'] = $payChannelPayerRealUid;
    }

    public function getPayChannelPayerRealUid()
    {
        return $this->payChannelPayerRealUid;
    }

    public function setPayeeId($payeeId)
    {
        $this->payeeId = $payeeId;
        $this->apiParas['payee_id'] = $payeeId;
    }

    public function getPayeeId()
    {
        return $this->payeeId;
    }

    public function setPayeeUserType($payeeUserType)
    {
        $this->payeeUserType = $payeeUserType;
        $this->apiParas['payee_user_type'] = $payeeUserType;
    }

    public function getPayeeUserType()
    {
        return $this->payeeUserType;
    }

    public function setPayerId($payerId)
    {
        $this->payerId = $payerId;
        $this->apiParas['payer_id'] = $payerId;
    }

    public function getPayerId()
    {
        return $this->payerId;
    }

    public function setPayerUserType($payerUserType)
    {
        $this->payerUserType = $payerUserType;
        $this->apiParas['payer_user_type'] = $payerUserType;
    }

    public function getPayerUserType()
    {
        return $this->payerUserType;
    }

    public function setReceiptorTypeList($receiptorTypeList)
    {
        $this->receiptorTypeList = $receiptorTypeList;
        $this->apiParas['receiptor_type_list'] = $receiptorTypeList;
    }

    public function getReceiptorTypeList()
    {
        return $this->receiptorTypeList;
    }

    public function setStatusList($statusList)
    {
        $this->statusList = $statusList;
        $this->apiParas['status_list'] = $statusList;
    }

    public function getStatusList()
    {
        return $this->statusList;
    }

    public function setTerminationReason($terminationReason)
    {
        $this->terminationReason = $terminationReason;
        $this->apiParas['termination_reason'] = $terminationReason;
    }

    public function getTerminationReason()
    {
        return $this->terminationReason;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParas['title'] = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingpay.bill.batchquerycount';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->payChannelList, 20, 'payChannelList');
        RequestCheckUtil::checkMaxListSize($this->receiptorTypeList, 20, 'receiptorTypeList');
        RequestCheckUtil::checkMaxListSize($this->statusList, 20, 'statusList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
