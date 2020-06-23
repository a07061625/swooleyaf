<?php
/**
 * 消息消费基类
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 12:38
 */
namespace SyMessageHandler;

/**
 * Class ConsumerBase
 * @package SyMessageHandler
 */
abstract class ConsumerBase extends HandlerBase
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }
}
