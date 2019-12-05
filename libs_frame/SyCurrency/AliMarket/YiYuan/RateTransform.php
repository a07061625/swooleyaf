<?php
/**
 * 汇率转换
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 17:17
 */
namespace SyCurrency\AliMarket\YiYuan;

use SyConstant\ErrorCode;
use SyCurrency\BaseAliMarketYiYuan;
use SyException\Currency\AliMarketYiYuanException;

/**
 * 汇率转换
 * @package SyCurrency\AliMarket\YiYuan
 */
class RateTransform extends BaseAliMarketYiYuan
{
    /**
     * 源货币类型
     * @var string
     */
    private $fromCode = '';
    /**
     * 目标货币类型
     * @var string
     */
    private $toCode = '';
    /**
     * 转换金额,单位为元
     * @var double
     */
    private $money = 0.0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/waihui-transform';
    }

    private function __clone()
    {
    }

    /**
     * @param string $fromCode
     * @throws \SyException\Currency\AliMarketYiYuanException
     */
    public function setFromCode(string $fromCode)
    {
        if (ctype_alnum($fromCode)) {
            $this->reqData['fromCode'] = $fromCode;
        } else {
            throw new AliMarketYiYuanException('源货币类型不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    /**
     * @param string $toCode
     * @throws \SyException\Currency\AliMarketYiYuanException
     */
    public function setToCode(string $toCode)
    {
        if (ctype_alnum($toCode)) {
            $this->reqData['toCode'] = $toCode;
        } else {
            throw new AliMarketYiYuanException('目标货币类型不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    /**
     * @param float $money
     * @throws \SyException\Currency\AliMarketYiYuanException
     */
    public function setMoney(float $money)
    {
        if ($money > 0) {
            $this->reqData['money'] = (string)$money;
        } else {
            throw new AliMarketYiYuanException('转换金额不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['fromCode'])) {
            throw new AliMarketYiYuanException('源货币类型不能为空', ErrorCode::CURRENCY_PARAM_ERROR);
        }
        if (!isset($this->reqData['toCode'])) {
            throw new AliMarketYiYuanException('目标货币类型不能为空', ErrorCode::CURRENCY_PARAM_ERROR);
        }
        if (!isset($this->reqData['money'])) {
            throw new AliMarketYiYuanException('转换金额不能为空', ErrorCode::CURRENCY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
