<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/20 0020
 * Time: 10:09
 */
namespace SyMessageQueue\Rabbit;

use DesignPatterns\Singletons\MessageQueueSingleton;
use Log\Log;
use MessageQueue\Consumer\RabbitConsumerContainer;
use Tool\Tool;

class MessageHandle {
    /**
     * @var \SyMessageQueue\Rabbit\MessageHandle
     */
    private static $instance = null;
    /**
     * @var \AMQPQueue
     */
    private $queue = null;
    /**
     * @var \MessageQueue\Consumer\RabbitConsumerContainer
     */
    private $container = null;
    /**
     * @var array
     */
    private $services = [];
    /**
     * @var int
     */
    private $messageHandleMaxNum = 0;

    private function __construct(){
        $this->queue = MessageQueueSingleton::getInstance()->getRabbitConsumer()->getQueue();
        $this->container = new RabbitConsumerContainer();
        $this->services = [];
        $this->messageHandleMaxNum = (int)Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.rabbit.consumer.msg.handle.max');
    }

    private function __clone(){
    }

    /**
     * @return \SyMessageQueue\Rabbit\MessageHandle
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $tag
     * @return \SyMessageQueue\ConsumerBase|null
     */
    private function getService(string $tag) {
        if (isset($this->services[$tag])) {
            return $this->services[$tag];
        }

        $service = $this->container->getObj($tag);
        if(!is_null($service)){
            $this->services[$tag] = $service;
            return $service;
        }

        return null;
    }

    public function handle(){
        $maxNum = $this->messageHandleMaxNum;

        while ($maxNum > 0) {
            $maxNum--;
            $message = $this->queue->get();
            if(empty($message)){
                break;
            }

            $routeKey = $message->getRoutingKey();
            $needArr = explode('.', $routeKey);
            $serviceTag = $needArr[1] ?? '';
            $service = $this->getService($serviceTag);
            if(is_null($service)){
                continue;
            }

            $msgData = Tool::jsonDecode($message->getBody());
            if(is_array($msgData)){
                try {
                    $service->handleMessage($msgData);
                } catch (\Exception $e) {
                    Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
                }
            } else {
                Log::error('rabbit消费数据格式错误,数据内容:' . $message->getBody());
            }
            $this->queue->ack($message->getDeliveryTag());
        }
    }
}