<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/21 0021
 * Time: 10:29
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class OrigOrderIdTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait OrigOrderIdTrait
{
    /**
     * @param string $origOrderId
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrigOrderId(string $origOrderId)
    {
        $length = strlen($origOrderId);
        if (ctype_digit($origOrderId) && ($length >= 8) && ($length <= 40)) {
            $this->reqData['origOrderId'] = $origOrderId;
        } else {
            throw new UnionException('原交易商户订单号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
