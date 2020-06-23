<?php
/**
 * 消息处理基类
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 12:40
 */
namespace SyMessageHandler;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\MessageHandler\MessageHandlerException;

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
     * @throws \SyException\MessageHandler\MessageHandlerException
     */
    public function __construct(int $handlerType)
    {
        if (!isset(Project::$messageHandlerQueues[$handlerType])) {
            throw new MessageHandlerException('消息处理类型不支持', ErrorCode::MESSAGE_HANDLER_PARAM_ERROR);
        }
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
