<?php
/**
 * 统一收单下单并支付页面接口
 * User: 姜伟
 * Date: 18-9-8
 * Time: 上午12:32
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use DesignPatterns\Singletons\AliPayConfigSingleton;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;

class PayPage extends AliPayBase
{
    /**
     * 商户订单号
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 销售产品码
     * @var string
     */
    private $product_code = '';
    /**
     * 订单总金额,单位为分
     * @var int
     */
    private $total_amount = 0;
    /**
     * 订单标题
     * @var string
     */
    private $subject = '';
    /**
     * 订单描述
     * @var string
     */
    private $body = '';
    /**
     * 绝对超时时间戳
     * @var int
     */
    private $time_expire = 0;
    /**
     * 商品信息
     * @var array
     */
    private $goods_detail = [];
    /**
     * 公用回传参数
     * @var array
     */
    private $passback_params = [];
    /**
     * 业务扩展参数
     * @var array
     */
    private $extend_params = [];
    /**
     * 商品主类型 0:虚拟类商品 1:实物类商品
     * @var string
     */
    private $goods_type = '';
    /**
     * 允许的最晚付款时间
     * @var string
     */
    private $timeout_express = '';
    /**
     * 优惠参数
     * @var array
     */
    private $promo_params = [];
    /**
     * 分账信息
     * @var array
     */
    private $royalty_info = [];
    /**
     * 受理商户信息
     * @var array
     */
    private $sub_merchant = [];
    /**
     * 可用渠道
     * @var array
     */
    private $enable_pay_channels = [];
    /**
     * 门店编号
     * @var string
     */
    private $store_id = '';
    /**
     * 禁用渠道
     * @var array
     */
    private $disable_pay_channels = [];
    /**
     * 扫码支付方式
     * @var string
     */
    private $qr_pay_mode = '';
    /**
     * 二维码宽度
     * @var int
     */
    private $qrcode_width = 0;
    /**
     * 结算信息
     * @var array
     */
    private $settle_info = [];
    /**
     * 开票信息
     * @var array
     */
    private $invoice_info = [];
    /**
     * 签约参数
     * @var array
     */
    private $agreement_sign_params = [];
    /**
     * 页面集成方式
     * @var string
     */
    private $integration_type = '';
    /**
     * 请求来源地址
     * @var string
     */
    private $request_from_url = '';
    /**
     * 业务信息
     * @var array
     */
    private $business_params = [];
    /**
     * 外部指定买家信息
     * @var array
     */
    private $ext_user_info = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $payConfig = AliPayConfigSingleton::getInstance()->getPayConfig($appId);
        $this->notify_url = $payConfig->getUrlNotify();
        $this->return_baseurl = $payConfig->getUrlReturn();
        $this->biz_content['product_code'] = 'FAST_INSTANT_TRADE_PAY';
        $this->biz_content['goods_type'] = '1';
        $this->biz_content['qr_pay_mode'] = '2';
        $this->biz_content['integration_type'] = 'PCWEB';
        $this->setMethod('alipay.trade.page.pay');
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
            $this->biz_content['total_amount'] = number_format(($totalAmount / 100), 2, '.', '');
        } else {
            throw new AliPayPayException('订单总金额不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
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
     * @param int $timeExpire
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setTimeExpire(int $timeExpire)
    {
        if ($timeExpire > time()) {
            $this->biz_content['time_expire'] = date('Y-m-d H:i', $timeExpire);
        } else {
            throw new AliPayPayException('绝对超时时间不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
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
     * @param array $passbackParams
     */
    public function setPassbackParams(array $passbackParams)
    {
        if (!empty($passbackParams)) {
            $this->biz_content['passback_params'] = http_build_query($passbackParams);
        }
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
     * @param string $goodsType
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setGoodsType(string $goodsType)
    {
        if (in_array($goodsType, ['0', '1'], true)) {
            $this->biz_content['goods_type'] = $goodsType;
        } else {
            throw new AliPayPayException('商品主类型不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
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
     * @param array $promoParams
     */
    public function setPromoParams(array $promoParams)
    {
        if (!empty($promoParams)) {
            $this->biz_content['promo_params'] = Tool::jsonEncode($promoParams, JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @param array $royaltyInfo
     */
    public function setRoyaltyInfo(array $royaltyInfo)
    {
        if (!empty($royaltyInfo)) {
            $this->biz_content['royalty_info'] = $royaltyInfo;
        }
    }

    /**
     * @param array $subMerchant
     */
    public function setSubMerchant(array $subMerchant)
    {
        if (!empty($subMerchant)) {
            $this->biz_content['sub_merchant'] = $subMerchant;
        }
    }

    /**
     * @param array $payChannels
     * @param int $channelType
     */
    public function setPayChannels(array $payChannels, int $channelType)
    {
        if (!empty($payChannels)) {
            if ($channelType == 0) {
                $this->biz_content['disable_pay_channels'] = implode(',', $payChannels);
            } else {
                $this->biz_content['enable_pay_channels'] = implode(',', $payChannels);
            }
        }
    }

    /**
     * @param string $storeId
     */
    public function setStoreId(string $storeId)
    {
        $this->biz_content['store_id'] = trim($storeId);
    }

    /**
     * @param string $qrPayMode
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setQrPayMode(string $qrPayMode)
    {
        if (in_array($qrPayMode, ['0', '1', '2', '3', '4'], true)) {
            $this->biz_content['qr_pay_mode'] = $qrPayMode;
        } else {
            throw new AliPayPayException('扫码支付方式不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param int $qrcodeWidth
     */
    public function setQrcodeWidth(int $qrcodeWidth)
    {
        if ($qrcodeWidth > 0) {
            $this->biz_content['qrcode_width'] = $qrcodeWidth;
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
     * @param array $invoiceInfo
     */
    public function setInvoiceInfo(array $invoiceInfo)
    {
        if (!empty($invoiceInfo)) {
            $this->biz_content['invoice_info'] = $invoiceInfo;
        }
    }

    /**
     * @param array $agreementSignParams
     */
    public function setAgreementSignParams(array $agreementSignParams)
    {
        if (!empty($agreementSignParams)) {
            $this->biz_content['agreement_sign_params'] = $agreementSignParams;
        }
    }

    /**
     * @param string $integrationType
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setIntegrationType(string $integrationType)
    {
        if (in_array($integrationType, ['ALIAPP', 'PCWEB'], true)) {
            $this->biz_content['integration_type'] = $integrationType;
        } else {
            throw new AliPayPayException('页面集成方式不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $requestFromUrl
     */
    public function setRequestFromUrl(string $requestFromUrl)
    {
        if (strlen($requestFromUrl) > 0) {
            $this->biz_content['request_from_url'] = $requestFromUrl;
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
     * @param array $extUserInfo
     */
    public function setExtUserInfo(array $extUserInfo)
    {
        if (!empty($extUserInfo)) {
            $this->biz_content['ext_user_info'] = $extUserInfo;
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
        if (!isset($this->biz_content['subject'])) {
            throw new AliPayPayException('订单标题不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
