<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 19:53
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetUniqIdTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetUniqIdTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUniqId(string $uniqId)
    {
        if (\strlen($uniqId) > 0) {
            $this->reqData['uniq_id'] = $uniqId;
        } else {
            throw new TBKException('设备编号不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
