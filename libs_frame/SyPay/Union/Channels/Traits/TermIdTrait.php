<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:29
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class TermIdTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait TermIdTrait
{
    /**
     * @param string $termId
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setTermId(string $termId)
    {
        if (strlen($termId) > 0) {
            $this->reqData['termId'] = $termId;
        } else {
            throw new UnionException('终端号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
