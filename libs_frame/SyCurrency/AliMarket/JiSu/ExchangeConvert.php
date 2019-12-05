<?php
/**
 * 汇率转换
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 17:17
 */
namespace SyCurrency\AliMarket\JiSu;

use SyConstant\ErrorCode;
use SyCurrency\BaseAliMarketJiSu;
use SyException\Currency\AliMarketJiSuException;

/**
 * 汇率转换
 * @package SyCurrency\AliMarket\JiSu
 */
class ExchangeConvert extends BaseAliMarketJiSu
{
    /**
     * 源货币类型
     * @var string
     */
    private $from = '';
    /**
     * 目标货币类型
     * @var string
     */
    private $to = '';
    /**
     * 转换金额,单位为元
     * @var double
     */
    private $amount = 0.0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/exchange/convert';
    }

    private function __clone()
    {
    }

    /**
     * @param string $fromCode
     * @throws \SyException\Currency\AliMarketJiSuException
     */
    public function setFromCode(string $fromCode)
    {
        if (ctype_alnum($fromCode)) {
            $this->reqData['from'] = $fromCode;
        } else {
            throw new AliMarketJiSuException('源货币类型不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    /**
     * @param string $toCode
     * @throws \SyException\Currency\AliMarketJiSuException
     */
    public function setToCode(string $toCode)
    {
        if (ctype_alnum($toCode)) {
            $this->reqData['to'] = $toCode;
        } else {
            throw new AliMarketJiSuException('目标货币类型不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    /**
     * @param float $money
     * @throws \SyException\Currency\AliMarketJiSuException
     */
    public function setAmount(float $money)
    {
        if ($money > 0) {
            $this->reqData['amount'] = (string)$money;
        } else {
            throw new AliMarketJiSuException('转换金额不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['from'])) {
            throw new AliMarketJiSuException('源货币类型不能为空', ErrorCode::CURRENCY_PARAM_ERROR);
        }
        if (!isset($this->reqData['to'])) {
            throw new AliMarketJiSuException('目标货币类型不能为空', ErrorCode::CURRENCY_PARAM_ERROR);
        }
        if (!isset($this->reqData['amount'])) {
            throw new AliMarketJiSuException('转换金额不能为空', ErrorCode::CURRENCY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
