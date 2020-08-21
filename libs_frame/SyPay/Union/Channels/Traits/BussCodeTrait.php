<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:53
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class BussCodeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait BussCodeTrait
{
    /**
     * @param string $bussCode
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setBussCode(string $bussCode)
    {
        $length = strlen($bussCode);
        if (ctype_digit($bussCode) && ($length >= 4) && ($length <= 20)) {
            $this->reqData['bussCode'] = $bussCode;
        } else {
            throw new UnionException('业务代码不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
