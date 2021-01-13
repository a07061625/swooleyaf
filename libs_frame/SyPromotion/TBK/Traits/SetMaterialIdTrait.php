<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/13 0013
 * Time: 16:52
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetMaterialIdTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetMaterialIdTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setMaterialId(int $materialId)
    {
        if ($materialId > 0) {
            $this->reqData['material_id'] = $materialId;
        } else {
            throw new TBKException('物料ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
