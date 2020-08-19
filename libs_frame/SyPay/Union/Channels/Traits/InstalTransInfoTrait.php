<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:09
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\UtilUnion;

/**
 * Trait InstalTransInfoTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait InstalTransInfoTrait
{
    /**
     * @param array $instalTransInfo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setInstalTransInfo(array $instalTransInfo)
    {
        if (empty($instalTransInfo)) {
            throw new UnionException('分期付款信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['instalTransInfo'] = UtilUnion::getSignStr($instalTransInfo);
    }
}
