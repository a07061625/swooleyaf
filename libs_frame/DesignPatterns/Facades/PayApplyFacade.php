<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-5
 * Time: 上午12:07
 */
namespace DesignPatterns\Facades;

use SyTrait\SimpleFacadeTrait;

abstract class PayApplyFacade
{
    use SimpleFacadeTrait;

    public static function handleCheckParams(array $data)
    {
        return static::checkParams($data);
    }

    public static function handleApply(array $data)
    {
        return static::apply($data);
    }

    abstract protected static function checkParams(array $data) : array;
    abstract protected static function apply(array $data) : array;
}
