<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/9/9
 * Time: 0:17
 */

namespace Psr\SimpleCache;

/**
 * 无效缓存参数异常的接口。
 *
 * 当传递一个无效参数时，必须抛出一个实现了此接口的异常。
 */
interface InvalidArgumentException extends CacheException
{
}
