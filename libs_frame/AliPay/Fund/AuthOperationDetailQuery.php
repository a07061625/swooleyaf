<?php
/**
 * 资金授权操作查询接口
 * User: 姜伟
 * Date: 2019/5/21 0021
 * Time: 11:36
 */
namespace AliPay\Fund;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayFundException;

class AuthOperationDetailQuery extends AliPayBase
{
    /**
     * 支付宝授权资金单号
     * @var string
     */
    private $auth_no = '';
    /**
     * 商户授权资金单号
     * @var string
     */
    private $out_order_no = '';
    /**
     * 支付宝授权资金操作流水号
     * @var string
     */
    private $operation_id = '';
    /**
     * 商户授权资金操作流水号
     * @var string
     */
    private $out_request_no = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.fund.auth.operation.detail.query');
    }

    public function __clone()
    {
    }

    /**
     * @param string $authNo
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setAuthNo(string $authNo)
    {
        if (ctype_digit($authNo)) {
            $this->biz_content['auth_no'] = $authNo;
        } else {
            throw new AliPayFundException('支付宝授权资金单号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $outOrderNo
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOutOrderNo(string $outOrderNo)
    {
        if (ctype_digit($outOrderNo)) {
            $this->biz_content['out_order_no'] = $outOrderNo;
        } else {
            throw new AliPayFundException('商户授权资金单号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $operationId
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOperationId(string $operationId)
    {
        if (ctype_digit($operationId)) {
            $this->biz_content['operation_id'] = $operationId;
        } else {
            throw new AliPayFundException('支付宝授权资金操作流水号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $outRequestNo
     * @throws \SyException\AliPay\AliPayFundException
     */
    public function setOutRequestNo(string $outRequestNo)
    {
        if (ctype_digit($outRequestNo)) {
            $this->biz_content['out_request_no'] = $outRequestNo;
        } else {
            throw new AliPayFundException('商户授权资金操作流水号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (isset($this->biz_content['auth_no'])) {
            unset($this->biz_content['out_order_no']);
        } elseif (!isset($this->biz_content['out_order_no'])) {
            throw new AliPayFundException('支付宝授权资金单号和商户授权资金单号不能同时为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
        if (isset($this->biz_content['operation_id'])) {
            unset($this->biz_content['out_request_no']);
        } elseif (!isset($this->biz_content['out_request_no'])) {
            throw new AliPayFundException('支付宝授权资金操作流水号和商户授权资金操作流水号不能同时为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
