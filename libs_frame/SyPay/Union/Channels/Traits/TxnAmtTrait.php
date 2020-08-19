<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:05
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class TxnAmtTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait TxnAmtTrait
{
    /**
     * @param int $txnAmt 交易金额,单位为分
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setTxnAmt(int $txnAmt)
    {
        if ($txnAmt > 0) {
            $this->reqData['txnAmt'] = $txnAmt;
        } else {
            throw new UnionException('交易金额不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
