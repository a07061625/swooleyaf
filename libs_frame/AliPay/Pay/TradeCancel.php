<?php
/**
 * 统一收单交易撤销接口
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 15:24
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayPayException;

class TradeCancel extends AliPayBase
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

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.trade.cancel');
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

    public function getDetail() : array
    {
        if ((!isset($this->biz_content['out_trade_no'])) && !isset($this->biz_content['trade_no'])) {
            throw new AliPayPayException('商户订单号和支付宝交易号不能都为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
