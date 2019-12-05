<?php
/**
 * 支持的外汇币种列表
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 17:17
 */
namespace SyCurrency\AliMarket\YiYuan;

use SyCurrency\BaseAliMarketYiYuan;

/**
 * 支持的外汇币种列表
 * @package SyCurrency\AliMarket\YiYuan
 */
class CurrencyList extends BaseAliMarketYiYuan
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/list';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
