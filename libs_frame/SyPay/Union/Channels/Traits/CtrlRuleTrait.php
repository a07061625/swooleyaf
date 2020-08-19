<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:24
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Trait CtrlRuleTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait CtrlRuleTrait
{
    /**
     * @param string $ctrlRule
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCtrlRule(string $ctrlRule)
    {
        if (ctype_digit($ctrlRule) && (strlen($ctrlRule) == 32)) {
            $this->reqData['ctrlRule'] = $ctrlRule;
        } else {
            throw new UnionException('控制规则不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
