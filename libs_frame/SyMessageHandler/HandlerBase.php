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
     * 队列标识,数字和字母组成
     * @var string
     */
    protected $queueTag = '';
    /**
     * 消息数据
     * @var array
     */
    protected $msgData = [];

    /**
     * @param int $handlerType 处理类型
     * @throws \SyException\MessageHandler\MessageHandlerException
     */
    public function __construct(int $handlerType)
    {
        $queueTag = Project::$messageHandlerQueues[$handlerType] ?? '';
        if (strlen($queueTag) == 0) {
            throw new MessageHandlerException('消息处理类型不支持', ErrorCode::MESSAGE_HANDLER_PARAM_ERROR);
        }
        $this->handlerType = $handlerType;
        $this->queueTag = $queueTag;
        $this->msgData = [
            'handler_type' => $handlerType,
            'data' => []
        ];
    }

    /**
     * @return int
     */
    public function getHandlerType() : int
    {
        return $this->handlerType;
    }

    /**
     * @return string
     */
    public function getQueueTag() : string
    {
        return $this->queueTag;
    }

    /**
     * @return array
     */
    public function getMsgData() : array
    {
        return $this->msgData;
    }
}
