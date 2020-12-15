<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/12/15 0015
 * Time: 18:34
 */

namespace SyTrait\Validators;

/**
 * Trait RequestRateTrait
 *
 * @package SyTrait\Validators
 */
trait RequestRateTrait
{
    public function getClientId(): string
    {
        if (isset($_SERVER['HTTP_sy-client'])) {
            return trim($_SERVER['HTTP_sy-client']);
        }

        return '';
    }
}
