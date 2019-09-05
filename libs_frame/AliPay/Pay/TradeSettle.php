<?php
/**
 * 统一收单交易结算接口
 * User: 姜伟
 * Date: 18-9-7
 * Time: 下午8:39
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayPayException;

class TradeSettle extends AliPayBase
{
    /**
     * 结算请求流水号
     * @var string
     */
    private $out_request_no = '';
    /**
     * 订单号
     * @var string
     */
    private $trade_no = '';
    /**
     * 分账明细信息
     * @var array
     */
    private $royalty_parameters = [];
    /**
     * 操作员id
     * @var string
     */
    private $operator_id = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.trade.order.settle');
    }

    public function __clone()
    {
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
            throw new AliPayPayException('结算请求流水号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
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
            throw new AliPayPayException('订单号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param array $royaltyParameters
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setRoyaltyParameters(array $royaltyParameters)
    {
        if (!empty($royaltyParameters)) {
            $this->biz_content['royalty_parameters'] = $royaltyParameters;
        } else {
            throw new AliPayPayException('分账明细信息不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $operatorId
     */
    public function setOperatorId(string $operatorId)
    {
        $this->biz_content['operator_id'] = trim($operatorId);
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['out_request_no'])) {
            throw new AliPayPayException('结算请求流水号不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['trade_no'])) {
            throw new AliPayPayException('订单号不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['royalty_parameters'])) {
            throw new AliPayPayException('分账明细信息不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
