<?php
/**
 * 统一收单交易创建接口
 * User: 姜伟
 * Date: 18-9-7
 * Time: 下午9:54
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use DesignPatterns\Singletons\AliPayConfigSingleton;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;

class TradeCreate extends AliPayBase
{
    /**
     * 商户订单号
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 卖家支付宝用户ID
     * @var string
     */
    private $seller_id = '';
    /**
     * 订单总金额,单位为分
     * @var int
     */
    private $total_amount = 0;
    /**
     * 可打折金额,单位为分
     * @var int
     */
    private $discountable_amount = 0;
    /**
     * 订单标题
     * @var string
     */
    private $subject = '';
    /**
     * 商品描述
     * @var string
     */
    private $body = '';
    /**
     * 买家支付宝用户ID
     * @var string
     */
    private $buyer_id = '';
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
     * 订单允许的最晚付款时间
     * @var string
     */
    private $timeout_express = '';
    /**
     * 描述结算信息
     * @var array
     */
    private $settle_info = [];
    /**
     * 业务信息
     * @var array
     */
    private $business_params = [];
    /**
     * 收货人及地址信息
     * @var array
     */
    private $receiver_address_info = [];
    /**
     * 物流信息
     * @var array
     */
    private $logistics_detail = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $payConfig = AliPayConfigSingleton::getInstance()->getPayConfig($appId);
        $this->notify_url = $payConfig->getUrlNotify();
        $this->biz_content['seller_id'] = $payConfig->getSellerId();
        $this->setMethod('alipay.trade.create');
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
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->biz_content['body'] = substr(trim($body), 0, 128);
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
     * @param array $settleInfo
     */
    public function setSettleInfo(array $settleInfo)
    {
        if (!empty($settleInfo)) {
            $this->biz_content['settle_info'] = $settleInfo;
        }
    }

    /**
     * @param array $businessParams
     */
    public function setBusinessParams(array $businessParams)
    {
        if (!empty($businessParams)) {
            $this->biz_content['business_params'] = Tool::jsonEncode($businessParams, JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @param array $receiverAddressInfo
     */
    public function setReceiverAddressInfo(array $receiverAddressInfo)
    {
        if (!empty($receiverAddressInfo)) {
            $this->biz_content['receiver_address_info'] = $receiverAddressInfo;
        }
    }

    /**
     * @param array $logisticsDetail
     */
    public function setLogisticsDetail(array $logisticsDetail)
    {
        if (!empty($logisticsDetail)) {
            $this->biz_content['logistics_detail'] = $logisticsDetail;
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['out_trade_no'])) {
            throw new AliPayPayException('商户订单号不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['total_amount'])) {
            throw new AliPayPayException('订单总金额不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if ($this->discountable_amount >= $this->total_amount) {
            throw new AliPayPayException('可打折金额必须小于订单总金额', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['subject'])) {
            throw new AliPayPayException('订单标题不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
