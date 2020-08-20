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
 * Class DiscountIdTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait DiscountIdTrait
{
    /**
     * @param string $discountId
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setDiscountId(string $discountId)
    {
        if (ctype_digit($discountId) && (strlen($discountId) == 16)) {
            $this->reqData['discountId'] = $discountId;
        } else {
            throw new UnionException('营销活动编号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
