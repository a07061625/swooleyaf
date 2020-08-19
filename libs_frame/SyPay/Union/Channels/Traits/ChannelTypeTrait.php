<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:51
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Trait ChannelTypeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait ChannelTypeTrait
{
    /**
     * @param string $channelType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setChannelType(string $channelType)
    {
        if (ctype_digit($channelType) && (strlen($channelType) == 2)) {
            $this->reqData['channelType'] = $channelType;
        } else {
            throw new UnionException('渠道类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
