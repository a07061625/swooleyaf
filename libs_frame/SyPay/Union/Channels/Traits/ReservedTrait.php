<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:59
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\UtilUnion;

/**
 * Trait ReservedTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait ReservedTrait
{
    /**
     * @param array $reserved
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setReserved(array $reserved)
    {
        if (empty($reserved)) {
            throw new UnionException('保留域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['reserved'] = UtilUnion::getSignStr($reserved);
    }
}
