<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:18
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class AccInfoTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait AccInfoTrait
{
    /**
     * @param string $accNo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setAccNo(string $accNo)
    {
        if (ctype_digit($accNo)) {
            $this->reqData['accNo'] = $accNo;
        } else {
            throw new UnionException('账号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $accType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setAccType(string $accType)
    {
        if (in_array($accType, ['01', '02', '03'])) {
            $this->reqData['accType'] = $accType;
        } else {
            throw new UnionException('账号类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
