<?php
/**
 * 消息消费基类
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 12:38
 */
namespace SyMessageHandler\Consumers;

use SyMessageHandler\HandlerBase;

/**
 * Class Base
 * @package SyMessageHandler\Consumers
 */
abstract class Base extends HandlerBase
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }
}
