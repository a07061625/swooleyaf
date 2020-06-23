<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 17:02
 */
namespace SyException\MessageHandler;

use SyException\BaseException;

/**
 * Class MessageHandlerException
 * @package SyException\MessageHandler
 */
class MessageHandlerException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '消息处理异常';
    }
}
