<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:27
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class SupPayTypeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait SupPayTypeTrait
{
    /**
     * @param array $supPayTypes
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setSupPayType(array $supPayTypes)
    {
        if (empty($supPayTypes)) {
            throw new UnionException('支持支付方式不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['supPayType'] = implode(',', $supPayTypes);
    }
}
