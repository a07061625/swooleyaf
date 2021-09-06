<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/9/6
 * Time: 14:03
 */

namespace SyTrait\Validators;

use SyTool\Tool;

/**
 * Trait ApiLimitTrait
 *
 * @package SyTrait\Validators
 */
trait ApiLimitTrait
{
    private function getApiExpireTime(): int
    {
        return Tool::getNowTime() + 100;
    }
}
