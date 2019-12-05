<?php
/**
 * 中国银行的实时汇率表
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 17:17
 */
namespace SyCurrency\AliMarket\YiYuan;

use SyConstant\ErrorCode;
use SyCurrency\BaseAliMarketYiYuan;
use SyException\Currency\AliMarketYiYuanException;

/**
 * 中国银行的实时汇率表
 * @package SyCurrency\AliMarket\YiYuan
 */
class RateListBOC extends BaseAliMarketYiYuan
{
    /**
     * 货币类型
     * @var string
     */
    private $code = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/waihui-list';
    }

    private function __clone()
    {
    }

    /**
     * @param string $code
     * @throws \SyException\Currency\AliMarketYiYuanException
     */
    public function setCode(string $code)
    {
        if (ctype_alnum($code)) {
            $this->reqData['code'] = $code;
        } else {
            throw new AliMarketYiYuanException('货币类型不合法', ErrorCode::CURRENCY_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
