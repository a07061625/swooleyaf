<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:28
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyTool\Tool;

/**
 * Class PayTimeoutTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait PayTimeoutTrait
{
    /**
     * @param int $payTimeout
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setPayTimeout(int $payTimeout)
    {
        if ($payTimeout > Tool::getNowTime()) {
            $this->reqData['payTimeout'] = date('YmdHis', $payTimeout);
        } else {
            throw new UnionException('支付超时时间不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
