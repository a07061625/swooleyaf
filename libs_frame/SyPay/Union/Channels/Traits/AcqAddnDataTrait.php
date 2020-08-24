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
 * Trait AcqAddnDataTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait AcqAddnDataTrait
{
    /**
     * @param array $acqAddnData
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setAcqAddnData(array $acqAddnData)
    {
        if (empty($acqAddnData)) {
            throw new UnionException('收款方附加数据不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['acqAddnData'] = UtilUnion::getSignStr($acqAddnData);
    }
}
