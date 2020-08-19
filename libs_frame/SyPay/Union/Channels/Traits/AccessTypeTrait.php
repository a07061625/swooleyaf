<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:44
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Trait AccessTypeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait AccessTypeTrait
{
    /**
     * @param int $accessType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setAccessType(int $accessType)
    {
        if (($accessType >= 0) && ($accessType <= 2)) {
            $this->reqData['accessType'] = $accessType;
        } else {
            throw new UnionException('接入类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
