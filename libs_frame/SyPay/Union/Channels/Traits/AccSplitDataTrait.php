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
 * Trait AccSplitDataTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait AccSplitDataTrait
{
    /**
     * @param array $accSplitData
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setAccSplitData(array $accSplitData)
    {
        if (empty($accSplitData)) {
            throw new UnionException('分账域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['accSplitData'] = UtilUnion::getSignStr($accSplitData);
    }
}
