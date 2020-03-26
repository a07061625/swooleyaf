<?php
/**
 * 支付宝订单信息同步接口
 * User: 姜伟
 * Date: 18-9-8
 * Time: 上午12:13
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;

class TradeSync extends AliPayBase
{
    /**
     * 支付宝交易号
     * @var string
     */
    private $trade_no = '';
    /**
     * 商户订单号
     * @var string
     */
    private $out_request_no = '';
    /**
     * 业务类型
     * @var string
     */
    private $biz_type = '';
    /**
     * 同步信息
     * @var array
     */
    private $order_biz_info = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.trade.orderinfo.sync');
    }

    public function __clone()
    {
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
     * @param string $outRequestNo
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setOutRequestNo(string $outRequestNo)
    {
        if (ctype_digit($outRequestNo)) {
            $this->biz_content['out_request_no'] = $outRequestNo;
        } else {
            throw new AliPayPayException('商户订单号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $bizType
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setBizType(string $bizType)
    {
        if (strlen($bizType) > 0) {
            $this->biz_content['biz_type'] = $bizType;
        } else {
            throw new AliPayPayException('业务类型不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param array $orderBizInfo
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setOrderBizInfo(array $orderBizInfo)
    {
        if (empty($orderBizInfo)) {
            throw new AliPayPayException('同步信息不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        } else {
            $this->biz_content['order_biz_info'] = Tool::jsonEncode($orderBizInfo, JSON_UNESCAPED_UNICODE);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['out_request_no'])) {
            throw new AliPayPayException('商户订单号不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['biz_type'])) {
            throw new AliPayPayException('业务类型不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['order_biz_info'])) {
            throw new AliPayPayException('同步信息不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
