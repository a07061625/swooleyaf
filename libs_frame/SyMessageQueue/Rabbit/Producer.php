<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/18 0018
 * Time: 18:32
 */
namespace SyMessageQueue\Rabbit;

use Constant\ErrorCode;
use Exception\Amqp\AmqpException;
use Tool\Tool;

class Producer {
    /**
     * @var \AMQPConnection|null
     */
    private $conn = null;
    /**
     * @var \AMQPExchange|null
     */
    private $exchange = null;

    public function __construct(){
        $configs = Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.rabbit');

        try {
            $this->conn = new \AMQPConnection($configs['conn']);
            $this->conn->pconnect();
            if(!$this->conn->isPersistent()){
                throw new AmqpException('amqp连接出错', ErrorCode::AMQP_CONNECT_ERROR);
            }

            $channel = new \AMQPChannel($this->conn);
            if (!$channel->isConnected()) {
                throw new AmqpException('amqp channel连接出错', ErrorCode::AMQP_CONNECT_ERROR);
            }

            $exchangeName = 'exchange' . SY_ENV . SY_PROJECT;
            $this->exchange = new \AMQPExchange($channel);
            $this->exchange->setFlags(AMQP_DURABLE); //持久化
            $this->exchange->setName($exchangeName);
            $this->exchange->setType(AMQP_EX_TYPE_TOPIC);
            $this->exchange->declareExchange();

            $queue = new \AMQPQueue($channel);
            $queue->setName('queue' . SY_ENV . SY_PROJECT);
            $queue->setFlags(AMQP_DURABLE);
            $queue->declareQueue();
            $queue->bind($exchangeName, SY_ENV . SY_PROJECT . '.*');
        } catch (\Exception $e) {
            $this->destroy();
            throw $e;
        }
    }

    public function __destruct(){
        $this->destroy();
    }

    private function __clone(){
    }

    private function destroy() {
        if(!is_null($this->exchange)){
            $this->exchange = null;
        }
        if(!is_null($this->conn)){
            if($this->conn->isPersistent()){
                $this->conn->pdisconnect();
            }
            $this->conn = null;
        }
    }

    /**
     * 发送主题数据
     * @param string $topic
     * @param array $data
     */
    public function sendTopicData(string $topic,array $data){
        $trueTopic = SY_ENV . SY_PROJECT . '.' . $topic;
        foreach ($data as $eData) {
            $this->exchange->publish(Tool::jsonEncode($eData, JSON_UNESCAPED_UNICODE), $trueTopic, AMQP_MANDATORY, [
                'delivery_mode' => 2,
            ]);
        }
    }
}