<?php
/**
 * 资金授权发码接口
 * User: 姜伟
 * Date: 2019/5/21 0021
 * Time: 11:36
 */
namespace AliPay\Fund;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayFundException;
use SyTool\Tool;

class AuthOrderVoucherCreate extends AliPayBase
{
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
    /**
     * 标价币种
     * @var string
     */
    private $trans_currency = '';
    /**
     * 结算币种
     * @var string
     */
    private $settle_currency = '';
    /**
     * 支付渠道
     * @var array
     */
    private $enable_pay_channels = [];

    private $totalTransCurrency = [
        'AUD' => '澳元',
        'NZD' => '新西兰元',
        'TWD' => '台币',
        'USD' => '美元',
        'EUR' => '欧元',
        'GBP' => '英镑',
    ];
    private $totalSettleCurrency = [
        'AUD' => '澳元',
        'NZD' => '新西兰元',
        'TWD' => '台币',
        'USD' => '美元',
        'EUR' => '欧元',
        'GBP' => '英镑',
    ];
    private $totalPayChannel = [
        'MONEY_FUND' => '余额宝',
        'PCREDIT_PAY' => '花呗',
        'CREDITZHIMA' => '芝麻信用',
    ];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.fund.auth.order.voucher.create');
        $this->biz_content['product_code'] = 'PRE_AUTH';
    }

    public function __clone()
    {
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

    /**
     * @param string $transCurrency
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setTransCurrency(string $transCurrency)
    {
        if (isset($this->totalTransCurrency[$transCurrency])) {
            $this->biz_content['trans_currency'] = $transCurrency;
        } else {
            throw new AliPayFundException('标价币种不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $settleCurrency
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setSettleCurrency(string $settleCurrency)
    {
        if (isset($this->totalSettleCurrency[$settleCurrency])) {
            $this->biz_content['settle_currency'] = $settleCurrency;
        } else {
            throw new AliPayFundException('结算币种不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $payChannel
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function addPayChannel(string $payChannel)
    {
        if (isset($this->totalPayChannel[$payChannel])) {
            $this->enable_pay_channels[$payChannel] = 1;
        } else {
            throw new AliPayFundException('支付渠道不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
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
        if (empty($this->enable_pay_channels)) {
            throw new AliPayFundException('支付渠道不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        $payChannels = [];
        foreach ($this->enable_pay_channels as $ePayChannel => $eVal) {
            $payChannels[] = [
                'payChannelType' => $ePayChannel,
            ];
        }
        $this->biz_content['enable_pay_channels'] = Tool::jsonEncode($payChannels, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
