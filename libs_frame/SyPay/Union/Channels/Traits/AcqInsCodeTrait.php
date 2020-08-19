<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:57
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Trait AcqInsCodeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait AcqInsCodeTrait
{
    /**
     * @param string $acqInsCode 收单机构代码
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setAcqInsCode(string $acqInsCode)
    {
        if (strlen($acqInsCode) > 0) {
            $this->reqData['acqInsCode'] = $acqInsCode;
        } else {
            throw new UnionException('收单机构代码不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
