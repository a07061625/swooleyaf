<?php
/**
 * 单笔转账到支付宝账户接口
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 15:18
 */
namespace AliPay\Fund;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayFundException;

class TransToAccountTransfer extends AliPayBase
{
    private $payeeTypes = [
        'ALIPAY_USERID' => 1,
        'ALIPAY_LOGONID' => 1,
    ];

    /**
     * 商户转账单号
     * @var string
     */
    private $out_biz_no = '';
    /**
     * 收款方账户类型
     * @var string
     */
    private $payee_type = '';
    /**
     * 收款方账户
     * @var string
     */
    private $payee_account = '';
    /**
     * 转账金额,单位为分
     * @var int
     */
    private $amount = 0;
    /**
     * 付款方姓名
     * @var string
     */
    private $payer_show_name = '';
    /**
     * 收款方真实姓名
     * @var string
     */
    private $payee_real_name = '';
    /**
     * 转账备注
     * @var string
     */
    private $remark = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.fund.trans.toaccount.transfer');
    }

    private function __clone()
    {
    }

    /**
     * @param string $outBizNo
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOutBizNo(string $outBizNo)
    {
        if (ctype_digit($outBizNo)) {
            $this->biz_content['out_biz_no'] = $outBizNo;
        } else {
            throw new AliPayFundException('商户转账单号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $payeeType
     * @param string $payeeAccount
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setPayeeTypeAndAccount(string $payeeType, string $payeeAccount)
    {
        if (!isset($this->payeeTypes[$payeeType])) {
            throw new AliPayFundException('账户类型不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        } elseif (strlen($payeeAccount) == 0) {
            throw new AliPayFundException('账户不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }

        $this->biz_content['payee_type'] = $payeeType;
        $this->biz_content['payee_account'] = $payeeAccount;
    }

    /**
     * @param int $amount
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setAmount(int $amount)
    {
        if ($amount >= 10) {
            $this->biz_content['amount'] = number_format(($amount / 100), 2, '.', '');
        } else {
            throw new AliPayFundException('转账金额必须大于0.1元', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $payerShowName
     */
    public function setPayerShowName(string $payerShowName)
    {
        $this->biz_content['payer_show_name'] = $payerShowName;
    }

    /**
     * @param string $payeeRealName
     */
    public function setPayeeRealName(string $payeeRealName)
    {
        $this->biz_content['payee_real_name'] = $payeeRealName;
    }

    /**
     * @param string $remark
     */
    public function setRemark(string $remark)
    {
        $this->biz_content['remark'] = $remark;
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['out_biz_no'])) {
            throw new AliPayFundException('商户转账单号不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['amount'])) {
            throw new AliPayFundException('转账金额不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (!isset($this->biz_content['payee_type'])) {
            throw new AliPayFundException('账户类型不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
