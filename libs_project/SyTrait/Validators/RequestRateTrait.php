<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/12/15 0015
 * Time: 18:34
 */

namespace SyTrait\Validators;

use SyConstant\Project;
use SyTool\Tool;

/**
 * Trait RequestRateTrait
 *
 * @package SyTrait\Validators
 */
trait RequestRateTrait
{
    public function getRateNum(): int
    {
        $rateNum = trim(Tool::getArrayVal($_SERVER, 'HTTP_' . Project::DATA_KEY_REQUEST_RATE_HEADER, '0'));
        if (ctype_digit($rateNum)) {
            return (int)$rateNum;
        }

        return 0;
    }
}
