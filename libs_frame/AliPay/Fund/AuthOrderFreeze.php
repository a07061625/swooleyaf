<?php
/**
 * 资金授权冻结接口
 * User: 姜伟
 * Date: 2019/5/21 0021
 * Time: 11:36
 */
namespace AliPay\Fund;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayFundException;
use SyTool\Tool;

class AuthOrderFreeze extends AliPayBase
{
    /**
     * 支付授权码
     * @var string
     */
    private $auth_code = '';
    /**
     * 授权码类型
     * @var string
     */
    private $auth_code_type = '';
    /**
     * 商户授权资金单号
     * @var string
     */
    private $out_order_no = '';
    /**
     * 商户授权资金操作流水号
     * @var string
     */
    private $out_request_no = '';
    /**
     * 标题
     * @var string
     */
    private $order_title = '';
    /**
     * 冻结金额
     * @var int
     */
    private $amount = 0;
    /**
     * 收款方支付宝账号
     * @var string
     */
    private $payee_logon_id = '';
    /**
     * 收款方支付宝用户号
     * @var string
     */
    private $payee_user_id = '';
    /**
     * 最晚付款时间
     * @var string
     */
    private $pay_timeout = '';
    /**
     * 扩展信息
     * @var array
     */
    private $extra_param = [];
    /**
     * 销售产品码
     * @var string
     */
    private $product_code = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.fund.auth.order.freeze');
        $this->biz_content['auth_code_type'] = 'bar_code';
        $this->biz_content['product_code'] = 'PRE_AUTH';
    }

    public function __clone()
    {
    }

    /**
     * @param string $authCode
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setAuthCode(string $authCode)
    {
        if (ctype_digit($authCode)) {
            $this->biz_content['auth_code'] = $authCode;
        } else {
            throw new AliPayFundException('支付授权码不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $outOrderNo
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOutOrderNo(string $outOrderNo)
    {
        if (ctype_digit($outOrderNo)) {
            $this->biz_content['out_order_no'] = $outOrderNo;
        } else {
            throw new AliPayFundException('商户授权资金单号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
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
     * @param string $orderTitle
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOrderTitle(string $orderTitle)
    {
        if (strlen($orderTitle) > 0) {
            $this->biz_content['order_title'] = mb_substr($orderTitle, 0, 50);
        } else {
            throw new AliPayFundException('标题不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
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
            throw new AliPayFundException('冻结金额不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $payeeLogonId
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setPayeeLogonId(string $payeeLogonId)
    {
        if (strlen($payeeLogonId) > 0) {
            $this->biz_content['payee_logon_id'] = $payeeLogonId;
        } else {
            throw new AliPayFundException('收款方支付宝账号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $payeeUserId
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setPayeeUserId(string $payeeUserId)
    {
        if (ctype_digit($payeeUserId)) {
            $this->biz_content['payee_user_id'] = $payeeUserId;
        } else {
            throw new AliPayFundException('收款方支付宝用户号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $payTimeout
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setPayTimeout(string $payTimeout)
    {
        if (strlen($payTimeout) > 0) {
            $this->biz_content['pay_timeout'] = $payTimeout;
        } else {
            throw new AliPayFundException('最晚付款时间不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
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
        if (!isset($this->biz_content['auth_code'])) {
            throw new AliPayFundException('支付授权码不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['out_order_no'])) {
            throw new AliPayFundException('商户授权资金单号不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['out_request_no'])) {
            throw new AliPayFundException('商户授权资金操作流水号不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['order_title'])) {
            throw new AliPayFundException('标题不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['amount'])) {
            throw new AliPayFundException('冻结金额不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
