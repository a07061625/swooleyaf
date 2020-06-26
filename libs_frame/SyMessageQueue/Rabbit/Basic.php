<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/25 0025
 * Time: 11:20
 */
namespace SyMessageQueue\Rabbit;

use SyConstant\ErrorCode;
use SyException\Amqp\AmqpException;
use SyTool\Tool;

/**
 * Class Basic
 * @package SyMessageQueue\Rabbit
 */
class Basic
{
    /**
     * @var \AMQPConnection
     */
    protected $conn = null;
    /**
     * @var \AMQPExchange|null
     */
    protected $exchange = null;
    /**
     * @var \AMQPQueue
     */
    protected $queue = null;
    /**
     * 标识
     * @var string
     */
    protected $tag = '';

    public function __construct(string $tag, string $type)
    {
        $configs = Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.rabbit');

        try {
            $this->tag = $tag;

            $this->conn = new \AMQPConnection($configs['conn']);
            $this->conn->connect();

            $channel = new \AMQPChannel($this->conn);
            if (!$channel->isConnected()) {
                throw new AmqpException('amqp channel连接出错', ErrorCode::AMQP_CONNECT_ERROR);
            }

            $exchangeName = 'exchange' . $type . $tag;
            $this->exchange = new \AMQPExchange($channel);
            $this->exchange->setFlags(AMQP_DURABLE); //持久化
            $this->exchange->setName($exchangeName);
            $this->exchange->setType(AMQP_EX_TYPE_TOPIC);
            $this->exchange->declareExchange();

            $this->queue = new \AMQPQueue($channel);
            $this->queue->setName('queue' . $type . $tag);
            $this->queue->setFlags(AMQP_DURABLE);
            $this->queue->declareQueue();
            $this->queue->bind($exchangeName, $tag . '.*');
        } catch (\Exception $e) {
            $this->destroy();
            throw $e;
        }
    }

    protected function destroy()
    {
        $this->tag = '';
        if (!is_null($this->queue)) {
            $this->queue = null;
        }
        if (!is_null($this->exchange)) {
            $this->exchange = null;
        }
        if (!is_null($this->conn)) {
            $this->conn->disconnect();
            $this->conn = null;
        }
    }

    /**
     * @return \AMQPExchange
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * @return \AMQPQueue
     */
    public function getQueue()
    {
        return $this->queue;
    }
}
