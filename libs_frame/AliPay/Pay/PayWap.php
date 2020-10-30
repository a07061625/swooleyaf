<?php
/**
 * 手机网站支付接口2.0
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 14:41
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use DesignPatterns\Singletons\AliPayConfigSingleton;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;

class PayWap extends AliPayBase
{
    /**
     * 表单ID
     *
     * @var string
     */
    private $formId = '';
    /**
     * 交易的具体描述信息
     *
     * @var string
     */
    private $body = '';
    /**
     * 商品的标题
     *
     * @var string
     */
    private $subject = '';
    /**
     * 商户网站唯一订单号
     *
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 该笔订单允许的最晚付款时间，逾期将关闭交易,取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天
     *
     * @var string
     */
    private $timeout_express = '';
    /**
     * 订单总金额,单位为分
     *
     * @var string
     */
    private $total_amount = '';
    /**
     * 收款支付宝用户ID
     *
     * @var string
     */
    private $seller_id = '';
    /**
     * 销售产品码
     *
     * @var string
     */
    private $product_code = '';
    /**
     * 商品主类型 0:虚拟类商品 1:实物类商品
     *
     * @var string
     */
    private $goods_type = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $payConfig = AliPayConfigSingleton::getInstance()->getPayConfig($appId);
        $this->formId = 'aliwappay' . Tool::getNowTime();
        $this->notify_url = $payConfig->getUrlNotify();
        $this->return_baseurl = $payConfig->getUrlReturn();
        $this->biz_content['seller_id'] = $payConfig->getSellerId();
        $this->biz_content['product_code'] = 'QUICK_WAP_PAY';
        $this->biz_content['goods_type'] = '1';
        $this->setMethod('alipay.trade.wap.pay');
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getFormId() : string
    {
        return $this->formId;
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
        if (strlen($this->return_url) == 0) {
            throw new AliPayPayException('同步通知地址不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
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
