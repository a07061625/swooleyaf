<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 10:06
 */
namespace SyException\Amqp;

use SyException\BaseException;

class AmqpException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = 'amqp异常';
    }
}
