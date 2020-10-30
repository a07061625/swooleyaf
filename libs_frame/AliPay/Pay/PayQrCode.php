<?php
/**
 * 统一收单线下交易预创建
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 14:49
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use DesignPatterns\Singletons\AliPayConfigSingleton;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayPayException;

class PayQrCode extends AliPayBase
{
    /**
     * 商户订单号
     *
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 订单总金额,单位为分
     *
     * @var string
     */
    private $total_amount = '';
    /**
     * 订单标题
     *
     * @var string
     */
    private $subject = '';
    /**
     * 商品的描述
     *
     * @var string
     */
    private $body = '';
    /**
     * 订单允许的最晚付款时间，逾期将关闭交易
     *
     * @var string
     */
    private $timeout_express = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $payConfig = AliPayConfigSingleton::getInstance()->getPayConfig($appId);
        $this->notify_url = $payConfig->getUrlNotify();
        $this->biz_content['seller_id'] = $payConfig->getSellerId();
        $this->setMethod('alipay.trade.precreate');
    }

    private function __clone()
    {
    }

    /**
     * @param string $subject
     *
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setSubject(string $subject)
    {
        $title = mb_substr(trim($subject), 0, 128);
        if (strlen($title) > 0) {
            $this->biz_content['subject'] = $title;
        } else {
            throw new AliPayPayException('订单标题不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $outTradeNo
     *
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
     * @param string $timeoutExpress
     */
    public function setTimeoutExpress(string $timeoutExpress)
    {
        if (strlen($timeoutExpress) > 0) {
            $this->biz_content['timeout_express'] = $timeoutExpress;
        }
    }

    /**
     * @param int $totalAmount
     *
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setTotalAmount(int $totalAmount)
    {
        if ($totalAmount > 0) {
            $this->biz_content['total_amount'] = number_format(($totalAmount / 100), 2, '.', '');
        } else {
            throw new AliPayPayException('订单总金额必须大于0', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->biz_content['body'] = substr(trim($body), 0, 128);
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['subject'])) {
            throw new AliPayPayException('订单标题不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['out_trade_no'])) {
            throw new AliPayPayException('商户订单号不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['total_amount'])) {
            throw new AliPayPayException('订单总金额不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
