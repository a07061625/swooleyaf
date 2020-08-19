<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:40
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class OrigQryIdTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait OrigQryIdTrait
{
    /**
     * @param string $origQryId
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setOrigQryId(string $origQryId)
    {
        if (ctype_digit($origQryId)) {
            $this->reqData['origQryId'] = $origQryId;
        } else {
            throw new UnionException('原交易查询流水号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
