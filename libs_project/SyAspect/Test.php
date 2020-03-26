<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/5/25 0025
 * Time: 17:30
 */
namespace SyAspect;

use SyLog\Log;
use SyTrait\SimpleTrait;

class Test extends BaseAspect
{
    use SimpleTrait;

    public static function handleBefore()
    {
        Log::log('before aspect');
    }

    public static function handleAfter()
    {
        Log::log('after aspect');
    }
}
