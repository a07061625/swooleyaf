<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/11/1 0001
 * Time: 10:55
 */
namespace SyTrait;

trait SingletonTrait
{
    private static $instance = null;

    private function __clone()
    {
    }
}
