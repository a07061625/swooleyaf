<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/8/13 0013
 * Time: 16:48
 */

namespace SyTrait\Validators;

/**
 * Trait RequestSignTrait
 *
 * @package SyTrait\Validators
 */
trait RequestSignTrait
{
    private static function getSignFactor(): array
    {
        return [
            'method' => 'md5',
            'secret' => 'r2n2uyactaw9tiniyk',
        ];
    }
}
