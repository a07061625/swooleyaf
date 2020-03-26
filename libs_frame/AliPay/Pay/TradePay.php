<?php
/**
 * 统一收单交易支付接口
 * User: 姜伟
 * Date: 18-9-7
 * Time: 下午11:26
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use DesignPatterns\Singletons\AliPayConfigSingleton;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;

class TradePay extends AliPayBase
{
    private $sceneList = [
        'bar_code' => 1,
        'wave_code' => 1,
    ];
    private $authConfirmModeList = [
        'COMPLETE' => 1,
        'NOT_COMPLETE' => 1,
    ];

    /**
     * 商户订单号
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 支付场景
     * @var string
     */
    private $scene = '';
    /**
     * 支付授权码
     * @var string
     */
    private $auth_code = '';
    /**
     * 销售产品码
     * @var string
     */
    private $product_code = '';
    /**
     * 订单标题
     * @var string
     */
    private $subject = '';
    /**
     * 买家支付宝用户ID
     * @var string
     */
    private $buyer_id = '';
    /**
     * 卖家支付宝用户ID
     * @var string
     */
    private $seller_id = '';
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
     * 订单总金额,单位为分
     * @var int
     */
    private $total_amount = 0;
    /**
     * 可打折金额金额,单位为分
     * @var int
     */
    private $discountable_amount = 0;
    /**
     * 订单描述
     * @var string
     */
    private $body = '';
    /**
     * 商品信息
     * @var array
     */
    private $goods_detail = [];
    /**
     * 操作员编号
     * @var string
     */
    private $operator_id = '';
    /**
     * 门店编号
     * @var string
     */
    private $store_id = '';
    /**
     * 终端编号
     * @var string
     */
    private $terminal_id = '';
    /**
     * 业务扩展参数
     * @var array
     */
    private $extend_params = [];
    /**
     * 允许的最晚付款时间
     * @var string
     */
    private $timeout_express = '';
    /**
     * 预授权确认模式
     * @var string
     */
    private $auth_confirm_mode = '';
    /**
     * 终端设备相关信息
     * @var array
     */
    private $terminal_params = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $payConfig = AliPayConfigSingleton::getInstance()->getPayConfig($appId);
        $this->notify_url = $payConfig->getUrlNotify();
        $this->scene = 'bar_code';
        $this->trans_currency = 'CNY';
        $this->settle_currency = 'CNY';
        $this->biz_content['seller_id'] = $payConfig->getSellerId();
        $this->setMethod('alipay.trade.pay');
    }

    public function __clone()
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
     * @param string $scene
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setScene(string $scene)
    {
        if (isset($this->sceneList[$scene])) {
            $this->biz_content['scene'] = $scene;
        } else {
            throw new AliPayPayException('支付场景不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $authCode
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setAuthCode(string $authCode)
    {
        if (ctype_digit($authCode)) {
            $this->biz_content['auth_code'] = $authCode;
        } else {
            throw new AliPayPayException('支付授权码不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $productCode
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setProductCode(string $productCode)
    {
        if (ctype_alnum($productCode)) {
            $this->biz_content['product_code'] = $productCode;
        } else {
            throw new AliPayPayException('销售产品码不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $subject
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
     * @param string $buyerId
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setBuyerId(string $buyerId)
    {
        if (ctype_digit($buyerId)) {
            $this->biz_content['buyer_id'] = $buyerId;
        } else {
            throw new AliPayPayException('买家支付宝用户ID不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $transCurrency
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setTransCurrency(string $transCurrency)
    {
        if (ctype_alpha($transCurrency)) {
            $this->biz_content['trans_currency'] = $transCurrency;
        } else {
            throw new AliPayPayException('标价币种不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $settleCurrency
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setSettleCurrency(string $settleCurrency)
    {
        if (ctype_alpha($settleCurrency)) {
            $this->biz_content['settle_currency'] = $settleCurrency;
        } else {
            throw new AliPayPayException('结算币种不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param int $totalAmount
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setTotalAmount(int $totalAmount)
    {
        if (($totalAmount > 0) && ($totalAmount <= 10000000000)) {
            $this->total_amount = $totalAmount;
            $this->biz_content['total_amount'] = number_format(($totalAmount / 100), 2, '.', '');
        } else {
            throw new AliPayPayException('订单总金额不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param int $discountableAmount
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setDiscountableAmount(int $discountableAmount)
    {
        if (($discountableAmount > 0) && ($discountableAmount <= 10000000000)) {
            $this->discountable_amount = $discountableAmount;
            $this->biz_content['discountable_amount'] = number_format(($discountableAmount / 100), 2, '.', '');
        } else {
            throw new AliPayPayException('可打折金额不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->biz_content['body'] = substr(trim($body), 0, 128);
    }

    /**
     * @param array $goodsDetail
     */
    public function setGoodsDetail(array $goodsDetail)
    {
        if (!empty($goodsDetail)) {
            $this->biz_content['goods_detail'] = $goodsDetail;
        }
    }

    /**
     * @param string $operatorId
     */
    public function setOperatorId(string $operatorId)
    {
        $this->biz_content['operator_id'] = trim($operatorId);
    }

    /**
     * @param string $storeId
     */
    public function setStoreId(string $storeId)
    {
        $this->biz_content['store_id'] = trim($storeId);
    }

    /**
     * @param string $terminalId
     */
    public function setTerminalId(string $terminalId)
    {
        $this->biz_content['terminal_id'] = trim($terminalId);
    }

    /**
     * @param array $extendParams
     */
    public function setExtendParams(array $extendParams)
    {
        if (!empty($extendParams)) {
            $this->biz_content['extend_params'] = $extendParams;
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
     * @param string $authConfirmMode
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setAuthConfirmMode(string $authConfirmMode)
    {
        if (isset($this->authConfirmModeList[$authConfirmMode])) {
            $this->biz_content['auth_confirm_mode'] = $authConfirmMode;
        } else {
            throw new AliPayPayException('预授权确认模式不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param array $terminalParams
     */
    public function setTerminalParams(array $terminalParams)
    {
        if (!empty($terminalParams)) {
            $this->biz_content['terminal_params'] = Tool::jsonEncode($terminalParams, JSON_UNESCAPED_UNICODE);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['out_trade_no'])) {
            throw new AliPayPayException('商户订单号不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['auth_code'])) {
            throw new AliPayPayException('支付授权码不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['subject'])) {
            throw new AliPayPayException('订单标题不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['total_amount'])) {
            throw new AliPayPayException('订单总金额不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if ($this->discountable_amount >= $this->total_amount) {
            throw new AliPayPayException('可打折金额必须小于订单总金额', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
