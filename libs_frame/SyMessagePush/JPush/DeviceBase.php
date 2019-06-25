<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 14:27
 */
namespace SyMessagePush\JPush;

use SyMessagePush\PushBaseJPush;

abstract class DeviceBase extends PushBaseJPush
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceDomain = 'https://device.jpush.cn';
    }
}
