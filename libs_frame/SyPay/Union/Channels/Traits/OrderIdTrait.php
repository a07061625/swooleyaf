<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:53
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class OrderIdTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait OrderIdTrait
{
    /**
     * @param string $orderId
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrderId(string $orderId)
    {
        $length = strlen($orderId);
        if (ctype_digit($orderId) && ($length >= 8) && ($length <= 40)) {
            $this->reqData['orderId'] = $orderId;
        } else {
            throw new UnionException('商户订单号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
