<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/20 0020
 * Time: 10:58
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class PayCardTypeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait PayCardTypeTrait
{
    /**
     * @param string $payCardType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setPayCardType(string $payCardType)
    {
        if (ctype_digit($payCardType) && (strlen($payCardType) == 2)) {
            $this->reqData['payCardType'] = $payCardType;
        } else {
            throw new UnionException('支付卡类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
