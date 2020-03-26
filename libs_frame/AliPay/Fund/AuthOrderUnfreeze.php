<?php
/**
 * 资金授权解冻接口
 * User: 姜伟
 * Date: 2019/5/21 0021
 * Time: 11:36
 */
namespace AliPay\Fund;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayFundException;
use SyTool\Tool;

class AuthOrderUnfreeze extends AliPayBase
{
    /**
     * 支付宝授权资金单号
     * @var string
     */
    private $auth_no = '';
    /**
     * 商户授权资金操作流水号
     * @var string
     */
    private $out_request_no = '';
    /**
     * 解冻金额
     * @var int
     */
    private $amount = 0;
    /**
     * 描述
     * @var string
     */
    private $remark = '';
    /**
     * 扩展信息
     * @var array
     */
    private $extra_param = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.fund.auth.order.unfreeze');
    }

    public function __clone()
    {
    }

    /**
     * @param string $authNo
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setAuthNo(string $authNo)
    {
        if (ctype_digit($authNo)) {
            $this->biz_content['auth_no'] = $authNo;
        } else {
            throw new AliPayFundException('支付宝授权资金单号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $outRequestNo
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOutRequestNo(string $outRequestNo)
    {
        if (ctype_digit($outRequestNo)) {
            $this->biz_content['out_request_no'] = $outRequestNo;
        } else {
            throw new AliPayFundException('商户授权资金操作流水号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param int $amount
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setAmount(int $amount)
    {

        if ($amount > 0) {
            $this->biz_content['amount'] = number_format(($amount / 100), 2, '.', '');
        } else {
            throw new AliPayFundException('解冻金额不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $remark
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setRemark(string $remark)
    {
        if (strlen($remark) > 0) {
            $this->biz_content['remark'] = mb_substr($remark, 0, 50);
        } else {
            throw new AliPayFundException('描述不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param array $extraParam
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setExtraParam(array $extraParam)
    {
        if (empty($extraParam)) {
            throw new AliPayFundException('扩展信息不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        $this->biz_content['extra_param'] = Tool::jsonEncode($extraParam, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['auth_no'])) {
            throw new AliPayFundException('支付宝授权资金单号不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['out_request_no'])) {
            throw new AliPayFundException('商户授权资金操作流水号不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['amount'])) {
            throw new AliPayFundException('解冻金额不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['remark'])) {
            throw new AliPayFundException('描述不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
