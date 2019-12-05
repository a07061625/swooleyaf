<?php
/**
 * 所有货币查询
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 17:17
 */
namespace SyCurrency\AliMarket\JiSu;

use SyCurrency\BaseAliMarketJiSu;

/**
 * 所有货币查询
 * @package SyCurrency\AliMarket\JiSu
 */
class ExchangeCurrency extends BaseAliMarketJiSu
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/exchange/currency';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
