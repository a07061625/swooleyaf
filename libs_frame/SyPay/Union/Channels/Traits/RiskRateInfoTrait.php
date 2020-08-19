<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:24
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\UtilUnion;

/**
 * Trait RiskRateInfoTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait RiskRateInfoTrait
{
    /**
     * @param array $riskRateInfo
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setRiskRateInfo(array $riskRateInfo)
    {
        if (empty($riskRateInfo)) {
            throw new UnionException('风控信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['riskRateInfo'] = UtilUnion::getSignStr($riskRateInfo);
    }
}
