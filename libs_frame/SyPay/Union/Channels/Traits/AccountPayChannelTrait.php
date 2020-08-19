<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:15
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class AccountPayChannelTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait AccountPayChannelTrait
{
    /**
     * @param string $accountPayChannel
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setAccountPayChannel(string $accountPayChannel)
    {
        if (strlen($accountPayChannel) > 0) {
            $this->reqData['accountPayChannel'] = $accountPayChannel;
        } else {
            throw new UnionException('预付卡通道不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
