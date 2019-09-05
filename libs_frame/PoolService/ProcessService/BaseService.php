<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/23 0023
 * Time: 13:05
 */
namespace PoolService\ProcessService;

use Response\Result;
use SyTrait\SimpleTrait;

abstract class BaseService
{
    use SimpleTrait;

    public static function execMessage(array $data) : Result
    {
        return static::handleMessage($data);
    }

    abstract protected static function handleMessage(array $data) : Result;
}
