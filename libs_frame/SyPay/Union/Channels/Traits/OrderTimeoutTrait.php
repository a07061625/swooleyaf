<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:21
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyTool\Tool;

/**
 * Trait OrderTimeoutTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait OrderTimeoutTrait
{
    /**
     * @param int $orderTimeout
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrderTimeout(int $orderTimeout)
    {
        if ($orderTimeout > Tool::getNowTime()) {
            $this->reqData['orderTimeout'] = $orderTimeout;
        } else {
            throw new UnionException('订单接收超时时间不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
