<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-16
 * Time: 下午1:29
 */
namespace SyMessageQueue;

use SyConstant\ErrorCode;
use SyException\MessageQueue\MessageQueueException;

class ConfigRedis
{
    /**
     * 消费者每次批处理消息数量
     * @var int
     */
    private $consumerBatchMsgNum = 0;
    /**
     * 消费者批处理重置的处理次数
     * @var int
     */
    private $consumerBatchResetTimes = 0;

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return int
     */
    public function getConsumerBatchMsgNum() : int
    {
        return $this->consumerBatchMsgNum;
    }

    /**
     * @param int $consumerBatchMsgNum
     * @throws \SyException\MessageQueue\MessageQueueException
     */
    public function setConsumerBatchMsgNum(int $consumerBatchMsgNum)
    {
        if (($consumerBatchMsgNum > 0) && ($consumerBatchMsgNum <= 10000)) {
            $this->consumerBatchMsgNum = $consumerBatchMsgNum;
        } else {
            throw new MessageQueueException('批处理消息数量不合法', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
        }
    }

    /**
     * @return int
     */
    public function getConsumerBatchResetTimes() : int
    {
        return $this->consumerBatchResetTimes;
    }

    /**
     * @param int $consumerBatchResetTimes
     * @throws \SyException\MessageQueue\MessageQueueException
     */
    public function setConsumerBatchResetTimes(int $consumerBatchResetTimes)
    {
        if (($consumerBatchResetTimes > 0) && ($consumerBatchResetTimes <= 100000)) {
            $this->consumerBatchResetTimes = $consumerBatchResetTimes;
        } else {
            throw new MessageQueueException('批处理重置处理次数不合法', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
        }
    }
}
