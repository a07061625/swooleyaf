<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:20
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class CustomerIpTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait CustomerIpTrait
{
    /**
     * @param string $customerIp
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCustomerIp(string $customerIp)
    {
        if (strlen($customerIp) > 0) {
            $this->reqData['customerIp'] = $customerIp;
        } else {
            throw new UnionException('持卡人IP不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
