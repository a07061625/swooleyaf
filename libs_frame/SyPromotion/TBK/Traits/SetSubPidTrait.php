<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 20:15
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;

/**
 * Trait SetSubPidTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetSubPidTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSubPid(string $subPid)
    {
        if (preg_match(ProjectBase::REGEX_PROMOTION_TBK_PID, $subPid) > 0) {
            $this->reqData['sub_pid'] = $subPid;
        } else {
            throw new TBKException('三方pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
