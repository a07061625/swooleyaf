<?php
/**
 * 查询转账订单接口
 * User: 姜伟
 * Date: 2019/5/21 0021
 * Time: 11:36
 */
namespace AliPay\Fund;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayFundException;

class TransOrderQuery extends AliPayBase
{
    /**
     * 商户转账单号
     * @var string
     */
    private $out_biz_no = '';
    /**
     * 支付宝转账单号
     * @var string
     */
    private $order_id = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.fund.trans.order.query');
    }

    public function __clone()
    {
    }

    /**
     * @param string $outBizNo
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOutBizNo(string $outBizNo)
    {
        if (ctype_digit($outBizNo)) {
            $this->biz_content['out_biz_no'] = $outBizNo;
        } else {
            throw new AliPayFundException('商户转账单号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $orderId
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOrderId(string $orderId)
    {
        if (ctype_digit($orderId)) {
            $this->biz_content['order_id'] = $orderId;
        } else {
            throw new AliPayFundException('支付宝转账单号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (isset($this->biz_content['order_id'])) {
            unset($this->biz_content['out_biz_no']);
        } elseif (!isset($this->biz_content['out_biz_no'])) {
            throw new AliPayFundException('商户转账单号和支付宝转账单号不能同时为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
