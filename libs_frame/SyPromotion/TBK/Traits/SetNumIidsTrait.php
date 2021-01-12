<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 19:38
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Class SetNumIidsTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetNumIidsTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setNumIidList(array $numIidList)
    {
        $idList = [];
        foreach ($numIidList as $eNumIid) {
            $trueId = \is_int($eNumIid) ? $eNumIid : 0;
            if ($trueId > 0) {
                $idList[$trueId] = 1;
            }
        }

        $needNum = \count($idList);
        if (0 == $needNum) {
            throw new TBKException('商品ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($needNum > 40) {
            throw new TBKException('商品ID列表不能超过40个', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['num_iids'] = implode(',', array_keys($idList));
    }
}
