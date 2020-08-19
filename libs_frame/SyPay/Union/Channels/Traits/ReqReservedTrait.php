<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:00
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Trait ReqReservedTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait ReqReservedTrait
{
    /**
     * @param string $reqReserved
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setReqReserved(string $reqReserved)
    {
        if (strlen($reqReserved) > 0) {
            $this->reqData['reqReserved'] = $reqReserved;
        } else {
            throw new UnionException('请求方保留域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
