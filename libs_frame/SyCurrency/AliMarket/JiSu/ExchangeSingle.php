<?php
/**
 * 单个货币查询
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 17:17
 */
namespace SyCurrency\AliMarket\JiSu;

use SyConstant\ErrorCode;
use SyCurrency\BaseAliMarketJiSu;
use SyException\Currency\AliMarketJiSuException;

/**
 * 单个货币查询
 * @package SyCurrency\AliMarket\JiSu
 */
class ExchangeSingle extends BaseAliMarketJiSu
{
    /**
     * 货币类型
     * @var string
     */
    private $currency = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/exchange/single';
    }

    private function __clone()
    {
    }

    /**
     * @param string $currency
     * @throws \SyException\Currency\AliMarketJiSuException
     */
    public function setCurrency(string $currency)
    {
        if (ctype_alnum($currency)) {
            $this->reqData['currency'] = $currency;
        } else {
            throw new AliMarketJiSuException('货币类型不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['currency'])) {
            throw new AliMarketJiSuException('货币类型不能为空', ErrorCode::CURRENCY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
