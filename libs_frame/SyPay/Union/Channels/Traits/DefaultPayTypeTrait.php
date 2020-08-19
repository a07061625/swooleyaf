<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:25
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class DefaultPayTypeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait DefaultPayTypeTrait
{
    /**
     * @param string $defaultPayType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setDefaultPayType(string $defaultPayType)
    {
        if (ctype_digit($defaultPayType) && (strlen($defaultPayType) == 4)) {
            $this->reqData['defaultPayType'] = $defaultPayType;
        } else {
            throw new UnionException('默认支付方式不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
