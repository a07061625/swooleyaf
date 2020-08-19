<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 15:20
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class BizTypeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait BizTypeTrait
{
    /**
     * @param string $bizType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setBizType(string $bizType)
    {
        if (in_array($bizType, ['000301', '000902'])) {
            $this->reqData['bizType'] = $bizType;
        } else {
            throw new UnionException('产品类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
