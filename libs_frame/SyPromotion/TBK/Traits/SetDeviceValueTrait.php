<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/13 0013
 * Time: 16:48
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetDeviceValueTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetDeviceValueTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceValue(string $deviceValue)
    {
        if (\strlen($deviceValue) > 0) {
            $this->reqData['device_value'] = $deviceValue;
        } else {
            throw new TBKException('设备号加密值不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
