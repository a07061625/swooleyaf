<?php
/**
 * 资金授权撤销接口
 * User: 姜伟
 * Date: 2019/5/21 0021
 * Time: 11:36
 */
namespace AliPay\Fund;

use AliPay\AliPayBase;
use Constant\ErrorCode;
use Exception\AliPay\AliPayFundException;

class AuthOperationCancel extends AliPayBase
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
    /**
     * 描述
     * @var string
     */
    private $remark = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.fund.auth.operation.cancel');
    }

    public function __clone()
    {
    }

    /**
     * @param string $authNo
     * @throws \Exception\AliPay\AliPayFundException
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
     * @throws \Exception\AliPay\AliPayFundException
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
     * @throws \Exception\AliPay\AliPayFundException
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
     * @throws \Exception\AliPay\AliPayFundException
     */
    public function setOutRequestNo(string $outRequestNo)
    {
        if (ctype_digit($outRequestNo)) {
            $this->biz_content['out_request_no'] = $outRequestNo;
        } else {
            throw new AliPayFundException('商户授权资金操作流水号不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }
    }

    /**
     * @param string $remark
     * @throws \Exception\AliPay\AliPayFundException
     */
    public function setRemark(string $remark)
    {
        if (strlen($remark) > 0) {
            $this->biz_content['remark'] = mb_substr($remark, 0, 50);
        } else {
            throw new AliPayFundException('描述不合法', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
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
        if (!isset($this->biz_content['remark'])) {
            throw new AliPayFundException('描述不能为空', ErrorCode::ALIPAY_FUND_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
