<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/21 0021
 * Time: 10:29
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class OrigTxnTimeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait OrigTxnTimeTrait
{
    /**
     * @param int $origTxnTime
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrigTxnTime(int $origTxnTime)
    {
        if ($origTxnTime > 0) {
            $this->reqData['origTxnTime'] = date('YmdHis', $origTxnTime);
        } else {
            throw new UnionException('原交易商户发送交易时间不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
