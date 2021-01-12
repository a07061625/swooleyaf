<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 19:45
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetAdZoneIdTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetAdZoneIdTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setAdZoneId(int $adZoneId)
    {
        if ($adZoneId > 0) {
            $this->reqData['adzone_id'] = $adZoneId;
        } else {
            throw new TBKException('广告位ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
