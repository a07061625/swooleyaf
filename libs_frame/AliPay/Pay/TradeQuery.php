<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 16:07
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use Constant\ErrorCode;
use Exception\AliPay\AliPayPayException;

class TradeQuery extends AliPayBase {
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

    public function __construct(string $appId) {
        parent::__construct($appId);
        $this->setMethod('alipay.trade.query');
    }

    private function __clone(){
    }

    /**
     * @param string $outTradeNo
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setOutTradeNo(string $outTradeNo) {
        if (ctype_digit($outTradeNo)) {
            $this->biz_content['out_trade_no'] = $outTradeNo;
        } else {
            throw new AliPayPayException('商户订单号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $tradeNo
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setTradeNo(string $tradeNo) {
        if (ctype_digit($tradeNo)) {
            $this->biz_content['trade_no'] = $tradeNo;
        } else {
            throw new AliPayPayException('支付宝交易号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if ((!isset($this->biz_content['out_trade_no'])) && !isset($this->biz_content['trade_no'])) {
            throw new AliPayPayException('商户订单号和支付宝交易号不能都为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}