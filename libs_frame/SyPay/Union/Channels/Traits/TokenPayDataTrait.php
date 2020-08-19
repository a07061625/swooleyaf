<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 14:03
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\UtilUnion;

/**
 * Class TokenPayDataTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait TokenPayDataTrait
{
    /**
     * @param array $tokenPayData
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setTokenPayData(array $tokenPayData)
    {
        if (empty($tokenPayData)) {
            throw new UnionException('标记化支付信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['tokenPayData'] = UtilUnion::getSignStr($tokenPayData);
    }
}
