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
 * Trait SetPageSizeTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetPageSizeTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize >= 1) && ($pageSize <= 100)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new TBKException('每页记录数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
