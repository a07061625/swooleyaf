<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/12 0012
 * Time: 19:08
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetPageNo2Trait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetPageNo2Trait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageNo(int $pageNo)
    {
        if ($pageNo >= 1) {
            $this->reqData['page_no'] = $pageNo;
        } else {
            throw new TBKException('页数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
