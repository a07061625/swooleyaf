<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-16
 * Time: 下午2:28
 */
namespace SyMessageQueue;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\MessageQueue\MessageQueueException;

abstract class ConsumerBase
{
    /**
     * 主题
     * @var string
     */
    private $topic = '';
    /**
     * 消息队列类型
     * @var string
     */
    private $mqType = '';

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getTopic() : string
    {
        return $this->topic;
    }

    /**
     * @return string
     */
    public function getMqType() : string
    {
        return $this->mqType;
    }

    /**
     * 处理消息
     * @param array $data
     * @return mixed
     */
    abstract public function handleMessage(array $data);

    /**
     * @param string $mqType
     * @param string $topic
     * @throws \SyException\MessageQueue\MessageQueueException
     */
    protected function setMqTypeAndTopic(string $mqType, string $topic)
    {
        switch ($mqType) {
            case Project::MESSAGE_QUEUE_TYPE_REDIS:
                $this->mqType = $mqType;
                $this->topic = SY_ENV . SY_PROJECT . $topic;
                break;
            case Project::MESSAGE_QUEUE_TYPE_KAFKA:
                $this->mqType = $mqType;
                $this->topic = SY_ENV . SY_PROJECT . $topic;
                break;
            case Project::MESSAGE_QUEUE_TYPE_RABBIT:
                $this->mqType = $mqType;
                $this->topic = SY_ENV . SY_PROJECT . '.' . $topic;
                break;
            default:
                throw new MessageQueueException('消息队列类型不支持', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
        }
    }
}
