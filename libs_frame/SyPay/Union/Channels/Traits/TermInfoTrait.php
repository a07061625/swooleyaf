<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:23
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\UtilUnion;

/**
 * Trait TermInfoTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait TermInfoTrait
{
    /**
     * @param array $termInfo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setTermInfo(array $termInfo)
    {
        if (empty($termInfo)) {
            throw new UnionException('终端信息不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['termInfo'] = UtilUnion::getSignStr($termInfo);
    }
}
