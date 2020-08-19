<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:13
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\UtilUnion;

/**
 * Class CustomerInfoTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait CustomerInfoTrait
{
    /**
     * @param array $customerInfo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCustomerInfo(array $customerInfo)
    {
        if (empty($customerInfo)) {
            throw new UnionException('银行卡验证信息不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['customerInfo'] = UtilUnion::getSignStr($customerInfo);
    }
}
