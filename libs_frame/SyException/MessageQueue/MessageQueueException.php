<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-23
 * Time: 下午11:46
 */
namespace SyException\MessageQueue;

use SyException\BaseException;

class MessageQueueException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '消息队列异常';
    }
}
