<?php
/**
 * 消息处理基类
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 12:40
 */
namespace SyMessageHandler;

/**
 * Class HandlerBase
 * @package SyMessageHandler
 */
abstract class HandlerBase
{
    /**
     * 处理类型
     * @var int
     */
    protected $handlerType = 0;

    /**
     * @param int $handlerType 处理类型
     */
    public function __construct(int $handlerType)
    {
        $this->handlerType = $handlerType;
    }

    /**
     * @return int
     */
    public function getHandlerType() : int
    {
        return $this->handlerType;
    }
}
