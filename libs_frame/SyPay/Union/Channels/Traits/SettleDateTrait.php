<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/20 0020
 * Time: 10:05
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class SettleDateTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait SettleDateTrait
{
    /**
     * @param string $settleDate
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setSettleDate(string $settleDate)
    {
        if (ctype_digit($settleDate) && (strlen($settleDate) == 4)) {
            $this->reqData['settleDate'] = $settleDate;
        } else {
            throw new UnionException('清算日期不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
