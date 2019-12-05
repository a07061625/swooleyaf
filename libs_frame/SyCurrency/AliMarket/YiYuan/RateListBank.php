<?php
/**
 * 十大银行实时汇率表
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 17:17
 */
namespace SyCurrency\AliMarket\YiYuan;

use SyConstant\ErrorCode;
use SyCurrency\BaseAliMarketYiYuan;
use SyException\Currency\AliMarketYiYuanException;

/**
 * 十大银行实时汇率表
 * @package SyCurrency\AliMarket\YiYuan
 */
class RateListBank extends BaseAliMarketYiYuan
{
    const BANK_TYPE_ICBC = 'ICBC';
    const BANK_TYPE_BOC = 'BOC';
    const BANK_TYPE_ABCHINA = 'ABCHINA';
    const BANK_TYPE_BANKCOMM = 'BANKCOMM';
    const BANK_TYPE_CCB = 'CCB';
    const BANK_TYPE_CMBCHINA = 'CMBCHINA';
    const BANK_TYPE_CEBBANK = 'CEBBANK';
    const BANK_TYPE_SPDB = 'SPDB';
    const BANK_TYPE_CIB = 'CIB';
    const BANK_TYPE_ECITIC = 'ECITIC';

    private static $totalBankType = [
        self::BANK_TYPE_ICBC => '工商银行',
        self::BANK_TYPE_BOC => '中国银行',
        self::BANK_TYPE_ABCHINA => '农业银行',
        self::BANK_TYPE_BANKCOMM => '交通银行',
        self::BANK_TYPE_CCB => '建设银行',
        self::BANK_TYPE_CMBCHINA => '招商银行',
        self::BANK_TYPE_CEBBANK => '光大银行',
        self::BANK_TYPE_SPDB => '浦发银行',
        self::BANK_TYPE_CIB => '兴业银行',
        self::BANK_TYPE_ECITIC => '中信银行',
    ];

    /**
     * 银行编码
     * @var string
     */
    private $bankCode = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/bank10';
    }

    private function __clone()
    {
    }

    /**
     * @param string $bankCode
     * @throws \SyException\Currency\AliMarketYiYuanException
     */
    public function setBankCode(string $bankCode)
    {
        if (isset(self::$totalBankType[$bankCode])) {
            $this->reqData['bankCode'] = $bankCode;
        } else {
            throw new AliMarketYiYuanException('银行编码不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['bankCode'])) {
            throw new AliMarketYiYuanException('银行编码不能为空', ErrorCode::CURRENCY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
