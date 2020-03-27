<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/18 0018
 * Time: 18:32
 */
namespace SyMessageQueue\Rabbit;

use SyConstant\ErrorCode;
use SyException\Amqp\AmqpException;
use SyTool\Tool;

class Consumer
{
    /**
     * @var \AMQPConnection
     */
    private $conn = null;
    /**
     * @var \AMQPQueue
     */
    private $queue = null;

    public function __construct()
    {
        $configs = Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.rabbit');

        try {
            $this->conn = new \AMQPConnection($configs['conn']);
            $this->conn->connect();

            $channel = new \AMQPChannel($this->conn);
            if (!$channel->isConnected()) {
                throw new AmqpException('amqp channel连接出错', ErrorCode::AMQP_CONNECT_ERROR);
            }

            $exchangeName = 'exchange' . SY_ENV . SY_PROJECT;
            $exchange = new \AMQPExchange($channel);
            $exchange->setFlags(AMQP_DURABLE); //持久化
            $exchange->setName($exchangeName);
            $exchange->setType(AMQP_EX_TYPE_TOPIC);
            $exchange->declareExchange();

            $this->queue = new \AMQPQueue($channel);
            $this->queue->setName('queue' . SY_ENV . SY_PROJECT);
            $this->queue->setFlags(AMQP_DURABLE);
            $this->queue->declareQueue();
            $this->queue->bind($exchangeName, SY_ENV . SY_PROJECT . '.*');
        } catch (\Exception $e) {
            $this->destroy();
            throw $e;
        }
    }

    public function __destruct()
    {
        $this->destroy();
    }

    private function __clone()
    {
    }

    /**
     * @return \AMQPQueue
     */
    public function getQueue()
    {
        return $this->queue;
    }

    private function destroy()
    {
        if (!is_null($this->queue)) {
            $this->queue = null;
        }
        if (!is_null($this->conn)) {
            $this->conn->disconnect();
            $this->conn = null;
        }
    }
}
