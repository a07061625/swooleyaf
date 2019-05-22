<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/5/22 0022
 * Time: 15:21
 */
namespace SyAspect;

abstract class BaseAspect
{
    /**
     * 前置切面处理
     * @return mixed
     */
    abstract public static function handleBefore();

    /**
     * 后置切面处理
     * @return mixed
     */
    abstract public static function handleAfter();
}
