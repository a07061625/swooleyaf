<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:30
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class UserMacTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait UserMacTrait
{
    /**
     * @param string $userMac
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setUserMac(string $userMac)
    {
        if (strlen($userMac) > 0) {
            $this->reqData['userMac'] = $userMac;
        } else {
            throw new UnionException('终端信息域不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
