<?php
/**
 * 查询对账单下载地址
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 15:20
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayPayException;

class BillDownload extends AliPayBase
{
    private static $billTypes = [
        'trade',
        'signcustomer',
    ];

    /**
     * 账单类型
     * @var string
     */
    private $bill_type = '';
    /**
     * 账单时间：日账单格式为yyyy-MM-dd，月账单格式为yyyy-MM
     * @var string
     */
    private $bill_date = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.data.dataservice.bill.downloadurl.query');
    }

    private function __clone()
    {
    }

    /**
     * @param string $billType
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setBillType(string $billType)
    {
        if (in_array($billType, self::$billTypes, true)) {
            $this->biz_content['bill_type'] = $billType;
        } else {
            throw new AliPayPayException('账单类型不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $billDate
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setBillDate(string $billDate)
    {
        if (preg_match('/^\d{4}(\-\d{2}){1,2}$/', $billDate) > 0) {
            $this->biz_content['bill_date'] = $billDate;
        } else {
            throw new AliPayPayException('账单时间不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['bill_type'])) {
            throw new AliPayPayException('账单类型不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['bill_date'])) {
            throw new AliPayPayException('账单时间不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
