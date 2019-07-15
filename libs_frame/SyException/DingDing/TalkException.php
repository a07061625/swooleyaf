<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/19 0019
 * Time: 12:33
 */
namespace SyException\DingDing;

use SyException\BaseException;

class TalkException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '钉钉异常';
    }
}
