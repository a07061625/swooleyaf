<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 22:39
 */
namespace SyPay\Union\Channels\Online;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseOnline;
use SyPay\UtilUnion;
use SyPay\UtilUnionChannels;
use SyTool\Tool;

/**
 * 消费接口
 * @package SyPay\Union\Channels\Online
 */
class Consume extends BaseOnline
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/frontTransReq.do';
        $this->reqData['bizType'] = '000201';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['currencyCode'] = '156';
        $this->reqData['txnType'] = '01';
        $this->reqData['accType'] = '01';
    }

    public function __clone()
    {
    }

    /**
     * @param string $backUrl
     * @throws \SyException\Pay\UnionException
     */
    public function setBackUrl(string $backUrl)
    {
        $trueUrl = trim($backUrl);
        if (strlen($trueUrl) > 0) {
            $this->reqData['backUrl'] = $trueUrl;
        } else {
            throw new UnionException('后台通知地址不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $currencyCode
     * @throws \SyException\Pay\UnionException
     */
    public function setCurrencyCode(string $currencyCode)
    {
        if (ctype_digit($currencyCode) && (strlen($currencyCode) == 3)) {
            $this->reqData['currencyCode'] = $currencyCode;
        } else {
            throw new UnionException('交易币种不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param int $txnAmt 交易金额,单位为分
     * @throws \SyException\Pay\UnionException
     */
    public function setTxnAmt(int $txnAmt)
    {
        if ($txnAmt > 0) {
            $this->reqData['txnAmt'] = $txnAmt;
        } else {
            throw new UnionException('交易金额不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $txnSubType
     * @throws \SyException\Pay\UnionException
     */
    public function setTxnSubType(string $txnSubType)
    {
        if (in_array($txnSubType, ['01', '03'])) {
            $this->reqData['txnSubType'] = $txnSubType;
        } else {
            throw new UnionException('交易子类不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param int $accessType
     * @throws \SyException\Pay\UnionException
     */
    public function setAccessType(int $accessType)
    {
        if (($accessType >= 0) && ($accessType <= 2)) {
            $this->reqData['accessType'] = $accessType;
        } else {
            throw new UnionException('接入类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $channelType
     * @throws \SyException\Pay\UnionException
     */
    public function setChannelType(string $channelType)
    {
        if (ctype_digit($channelType) && (strlen($channelType) == 2)) {
            $this->reqData['channelType'] = $channelType;
        } else {
            throw new UnionException('渠道类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $orderId
     * @throws \SyException\Pay\UnionException
     */
    public function setOrderId(string $orderId)
    {
        $length = strlen($orderId);
        if (ctype_digit($orderId) && ($length >= 8) && ($length <= 40)) {
            $this->reqData['orderId'] = $orderId;
        } else {
            throw new UnionException('商户订单号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $orderDesc 订单描述
     */
    public function setOrderDesc(string $orderDesc)
    {
        if (strlen($orderDesc) > 0) {
            $this->reqData['orderDesc'] = $orderDesc;
        }
    }

    /**
     * @param string $subMerId 二级商户代码
     */
    public function setSubMerId(string $subMerId)
    {
        if (strlen($subMerId) > 0) {
            $this->reqData['subMerId'] = $subMerId;
        }
    }

    /**
     * @param string $subMerAbbr 二级商户简称
     */
    public function setSubMerAbbr(string $subMerAbbr)
    {
        if (strlen($subMerAbbr) > 0) {
            $this->reqData['subMerAbbr'] = $subMerAbbr;
        }
    }

    /**
     * @param string $subMerName 二级商户名称
     */
    public function setSubMerName(string $subMerName)
    {
        if (strlen($subMerName)) {
            $this->reqData['subMerName'] = $subMerName;
        }
    }

    /**
     * @param string $issInsCode 发卡机构代码
     */
    public function setIssInsCode(string $issInsCode)
    {
        if (strlen($issInsCode) > 0) {
            $this->reqData['issInsCode'] = $issInsCode;
        }
    }

    /**
     * @param array $instalTransInfo
     * @throws \SyException\Pay\UnionException
     */
    public function setInstalTransInfo(array $instalTransInfo)
    {
        if (empty($instalTransInfo)) {
            throw new UnionException('分期付款信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['instalTransInfo'] = UtilUnion::getSignStr($instalTransInfo);
    }

    /**
     * @param string $encryptCertId
     * @throws \SyException\Pay\UnionException
     */
    public function setEncryptCertId(string $encryptCertId)
    {
        if (ctype_digit($encryptCertId)) {
            $this->reqData['encryptCertId'] = $encryptCertId;
        } else {
            throw new UnionException('加密证书ID不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $frontUrl
     * @throws \SyException\Pay\UnionException
     */
    public function setFrontUrl(string $frontUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $frontUrl) > 0) {
            $this->reqData['frontUrl'] = $frontUrl;
        } else {
            throw new UnionException('前台通知地址不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $bizScene
     * @throws \SyException\Pay\UnionException
     */
    public function setBizScene(string $bizScene)
    {
        if (ctype_digit($bizScene) && (strlen($bizScene) == 6)) {
            $this->reqData['bizScene'] = $bizScene;
        } else {
            throw new UnionException('业务种类不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param array $customerInfo
     * @throws \SyException\Pay\UnionException
     */
    public function setCustomerInfo(array $customerInfo)
    {
        if (empty($customerInfo)) {
            throw new UnionException('银行卡验证信息不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['customerInfo'] = UtilUnion::getSignStr($customerInfo);
    }

    /**
     * @param array $cardTransData
     * @throws \SyException\Pay\UnionException
     */
    public function setCardTransData(array $cardTransData)
    {
        if (empty($cardTransData)) {
            throw new UnionException('有卡交易信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['cardTransData'] = UtilUnion::getSignStr($cardTransData);
    }

    /**
     * @param string $accountPayChannel
     * @throws \SyException\Pay\UnionException
     */
    public function setAccountPayChannel(string $accountPayChannel)
    {
        if (strlen($accountPayChannel) > 0) {
            $this->reqData['accountPayChannel'] = $accountPayChannel;
        } else {
            throw new UnionException('预付卡通道不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $accNo
     * @throws \SyException\Pay\UnionException
     */
    public function setAccNo(string $accNo)
    {
        if (ctype_digit($accNo)) {
            $this->reqData['accNo'] = $accNo;
        } else {
            throw new UnionException('账号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $accType
     * @throws \SyException\Pay\UnionException
     */
    public function setAccType(string $accType)
    {
        if (in_array($accType, ['01', '02', '03'])) {
            $this->reqData['accType'] = $accType;
        } else {
            throw new UnionException('账号类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $certId
     * @throws \SyException\Pay\UnionException
     */
    public function setCertId(string $certId)
    {
        if (ctype_digit($certId)) {
            $this->reqData['certId'] = $certId;
        } else {
            throw new UnionException('证书ID不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param array $reserved
     * @throws \SyException\Pay\UnionException
     */
    public function setReserved(array $reserved)
    {
        if (empty($reserved)) {
            throw new UnionException('保留域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['reserved'] = UtilUnion::getSignStr($reserved);
    }

    /**
     * @param string $customerIp
     * @throws \SyException\Pay\UnionException
     */
    public function setCustomerIp(string $customerIp)
    {
        if (strlen($customerIp) > 0) {
            $this->reqData['customerIp'] = $customerIp;
        } else {
            throw new UnionException('持卡人IP不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param int $orderTimeout
     * @throws \SyException\Pay\UnionException
     */
    public function setOrderTimeout(int $orderTimeout)
    {
        if ($orderTimeout > Tool::getNowTime()) {
            $this->reqData['orderTimeout'] = $orderTimeout;
        } else {
            throw new UnionException('订单接收超时时间不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param array $accSplitData
     * @throws \SyException\Pay\UnionException
     */
    public function setAccSplitData(array $accSplitData)
    {
        if (empty($accSplitData)) {
            throw new UnionException('分账域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['accSplitData'] = UtilUnion::getSignStr($accSplitData);
    }

    /**
     * @param array $riskRateInfo
     * @throws \SyException\Pay\UnionException
     */
    public function setRiskRateInfo(array $riskRateInfo)
    {
        if (empty($riskRateInfo)) {
            throw new UnionException('风控信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['riskRateInfo'] = UtilUnion::getSignStr($riskRateInfo);
    }

    /**
     * @param string $ctrlRule
     * @throws \SyException\Pay\UnionException
     */
    public function setCtrlRule(string $ctrlRule)
    {
        if (ctype_digit($ctrlRule) && (strlen($ctrlRule) == 32)) {
            $this->reqData['ctrlRule'] = $ctrlRule;
        } else {
            throw new UnionException('控制规则不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $defaultPayType
     * @throws \SyException\Pay\UnionException
     */
    public function setDefaultPayType(string $defaultPayType)
    {
        if (ctype_digit($defaultPayType) && (strlen($defaultPayType) == 4)) {
            $this->reqData['defaultPayType'] = $defaultPayType;
        } else {
            throw new UnionException('默认支付方式不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $reqReserved
     * @throws \SyException\Pay\UnionException
     */
    public function setReqReserved(string $reqReserved)
    {
        if (strlen($reqReserved) > 0) {
            $this->reqData['reqReserved'] = $reqReserved;
        } else {
            throw new UnionException('请求方保留域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $frontFailUrl
     * @throws \SyException\Pay\UnionException
     */
    public function setFrontFailUrl(string $frontFailUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $frontFailUrl) > 0) {
            $this->reqData['frontFailUrl'] = $frontFailUrl;
        } else {
            throw new UnionException('失败交易前台跳转地址不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param array $supPayTypes
     * @throws \SyException\Pay\UnionException
     */
    public function setSupPayType(array $supPayTypes)
    {
        if (empty($supPayTypes)) {
            throw new UnionException('支持支付方式不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['supPayType'] = implode(',', $supPayTypes);
    }

    /**
     * @param int $payTimeout
     * @throws \SyException\Pay\UnionException
     */
    public function setPayTimeout(int $payTimeout)
    {
        if ($payTimeout > Tool::getNowTime()) {
            $this->reqData['payTimeout'] = date('YmdHis', $payTimeout);
        } else {
            throw new UnionException('支付超时时间不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $termId
     * @throws \SyException\Pay\UnionException
     */
    public function setTermId(string $termId)
    {
        if (strlen($termId) > 0) {
            $this->reqData['termId'] = $termId;
        } else {
            throw new UnionException('终端号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $userMac
     * @throws \SyException\Pay\UnionException
     */
    public function setUserMac(string $userMac)
    {
        if (strlen($userMac) > 0) {
            $this->reqData['userMac'] = $userMac;
        } else {
            throw new UnionException('终端信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @return array
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['txnAmt'])) {
            throw new UnionException('交易金额不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['txnSubType'])) {
            throw new UnionException('交易子类不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['accessType'])) {
            throw new UnionException('接入类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['channelType'])) {
            throw new UnionException('渠道类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['orderId'])) {
            throw new UnionException('商户订单号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
