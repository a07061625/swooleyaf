<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:14
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\UtilUnion;

/**
 * Class CardTransDataTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait CardTransDataTrait
{
    /**
     * @param array $cardTransData
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCardTransData(array $cardTransData)
    {
        if (empty($cardTransData)) {
            throw new UnionException('有卡交易信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $this->reqData['cardTransData'] = UtilUnion::getSignStr($cardTransData);
    }
}
