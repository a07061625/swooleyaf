<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 19:36
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetPlatformTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetPlatformTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPlatform(int $platform)
    {
        if (\in_array($platform, [1, 2])) {
            $this->reqData['platform'] = $platform;
        } else {
            throw new TBKException('链接形式不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
