<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/13 0013
 * Time: 16:49
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetDeviceTypeTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetDeviceTypeTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceType(string $deviceType)
    {
        if (\in_array($deviceType, ['IMEI', 'IDFA', 'UTDID', 'OAID'])) {
            $this->reqData['device_type'] = $deviceType;
        } else {
            throw new TBKException('设备号类型不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
