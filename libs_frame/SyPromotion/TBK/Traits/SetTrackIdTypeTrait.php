<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 19:54
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetTrackIdTypeTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetTrackIdTypeTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setTrackIdType(int $trackIdType)
    {
        if (\in_array($trackIdType, [1, 2, 3])) {
            $this->reqData['track_id_type'] = $trackIdType;
        } else {
            throw new TBKException('平台类型不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
