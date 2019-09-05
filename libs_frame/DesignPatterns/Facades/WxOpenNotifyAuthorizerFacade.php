<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 8:29
 */
namespace DesignPatterns\Facades;

use SyTrait\SimpleFacadeTrait;

abstract class WxOpenNotifyAuthorizerFacade
{
    use SimpleFacadeTrait;

    public static function acceptNotify(array $data)
    {
        return static::responseNotify($data);
    }

    abstract protected static function responseNotify(array $data) : array;
}
