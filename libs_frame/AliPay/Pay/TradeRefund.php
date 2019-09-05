<?php
/**
 * 统一收单交易退款接口
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 16:23
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayPayException;

class TradeRefund extends AliPayBase
{
    /**
     * 商户订单号
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 支付宝交易号
     * @var string
     */
    private $trade_no = '';
    /**
     * 退款的金额,该金额不能大于订单金额,单位为分
     * @var string
     */
    private $refund_amount = '';
    /**
     * 退款的原因说明
     * @var string
     */
    private $refund_reason = '';
    /**
     * 退款单号
     * @var string
     */
    private $out_request_no = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.trade.refund');
    }

    private function __clone()
    {
    }

    /**
     * @param string $outTradeNo
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setOutTradeNo(string $outTradeNo)
    {
        if (ctype_digit($outTradeNo)) {
            $this->biz_content['out_trade_no'] = $outTradeNo;
        } else {
            throw new AliPayPayException('商户订单号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $tradeNo
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setTradeNo(string $tradeNo)
    {
        if (ctype_digit($tradeNo)) {
            $this->biz_content['trade_no'] = $tradeNo;
        } else {
            throw new AliPayPayException('支付宝交易号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param int $refundAmount
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setRefundAmount(int $refundAmount)
    {
        if ($refundAmount > 0) {
            $this->biz_content['refund_amount'] = number_format(($refundAmount / 100), 2, '.', '');
        } else {
            throw new AliPayPayException('退款金额必须大于0', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $refundReason
     */
    public function setRefundReason(string $refundReason)
    {
        if (strlen($refundReason) > 0) {
            $this->biz_content['refund_reason'] = mb_substr($refundReason, 0, 80);
        }
    }

    /**
     * @param string $refundNo
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setRefundNo(string $refundNo)
    {
        if (ctype_digit($refundNo)) {
            $this->biz_content['out_request_no'] = $refundNo;
        } else {
            throw new AliPayPayException('退款单号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if ((!isset($this->biz_content['out_trade_no'])) && !isset($this->biz_content['trade_no'])) {
            throw new AliPayPayException('商户订单号和支付宝交易号不能都为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['refund_amount'])) {
            throw new AliPayPayException('退款金额不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['out_request_no'])) {
            throw new AliPayPayException('退款单号不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
