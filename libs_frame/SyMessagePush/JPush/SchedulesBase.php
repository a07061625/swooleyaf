<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 14:27
 */
namespace SyMessagePush\JPush;

use SyMessagePush\PushBaseJPush;

abstract class SchedulesBase extends PushBaseJPush
{
    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->serviceDomain = 'https://api.jpush.cn';
    }
}
