<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 20:02
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetUnidTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetUnidTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUnid(string $unid)
    {
        if (ctype_alnum($unid) && (\strlen($unid) <= 12)) {
            $this->reqData['unid'] = $unid;
        } else {
            throw new TBKException('推广渠道不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
