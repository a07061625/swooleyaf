<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/7/29 0029
 * Time: 17:53
 */
namespace SyException\Cron;

use SyException\BaseException;

class CronException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = 'Cron计划任务异常';
    }
}
