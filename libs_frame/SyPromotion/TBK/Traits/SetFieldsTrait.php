<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 19:34
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetFieldsTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetFieldsTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setFields(array $fields)
    {
        $fieldList = [];
        foreach ($fields as $eField) {
            $trueField = \is_string($eField) ? trim($eField) : '';
            if (\strlen($trueField) > 0) {
                $fieldList[$trueField] = 1;
            }
        }
        if (empty($fieldList)) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['fields'] = implode(',', array_keys($fieldList));
    }
}
