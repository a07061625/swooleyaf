<?php
/**
 * 消息生产基类
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 12:38
 */
namespace SyMessageHandler;

/**
 * Class ProducerBase
 * @package SyMessageHandler
 */
abstract class ProducerBase extends HandlerBase
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }
}
