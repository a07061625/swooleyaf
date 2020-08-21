<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:09
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\UtilUnion;

/**
 * Trait BillQueryInfoTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait BillQueryInfoTrait
{
    /**
     * @param array $billQueryInfo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setBillQueryInfo(array $billQueryInfo)
    {
        if (empty($billQueryInfo)) {
            throw new UnionException('账单要素不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['billQueryInfo'] = UtilUnion::getSignStr($billQueryInfo);
    }
}
