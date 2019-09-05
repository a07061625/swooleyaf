<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 15:51
 */
namespace DesignPatterns\Facades;

use SyTrait\SimpleFacadeTrait;

abstract class UserLoginFacade
{
    use SimpleFacadeTrait;

    public static function handleCheckParams(array $data)
    {
        return static::checkParams($data);
    }

    public static function handleLogin(array $data)
    {
        return static::login($data);
    }

    abstract protected static function checkParams(array $data) : array;
    abstract protected static function login(array $data) : array;
}
