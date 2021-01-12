<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 20:29
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetPageNoTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetPageNoTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageNo(int $pageNo)
    {
        if (($pageNo >= 1) && ($pageNo <= 100)) {
            $this->reqData['page_no'] = $pageNo;
        } else {
            throw new TBKException('页数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
