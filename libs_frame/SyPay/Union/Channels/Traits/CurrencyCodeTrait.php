<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:04
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Trait CurrencyCodeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait CurrencyCodeTrait
{
    /**
     * @param string $currencyCode
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCurrencyCode(string $currencyCode)
    {
        if (ctype_digit($currencyCode) && (strlen($currencyCode) == 3)) {
            $this->reqData['currencyCode'] = $currencyCode;
        } else {
            throw new UnionException('交易币种不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
