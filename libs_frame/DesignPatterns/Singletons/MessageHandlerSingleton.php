<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 21:52
 */
namespace DesignPatterns\Singletons;

use DesignPatterns\Factories\CacheSimpleFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\MessageHandler\MessageHandlerException;
use SyLog\Log;
use SyMessageHandler\ConsumerContainer;
use SyMessageHandler\ProducerContainer;
use SyTool\Tool;
use SyTrait\SingletonTrait;

/**
 * Class MessageHandlerSingleton
 * @package DesignPatterns\Singletons
 */
class MessageHandlerSingleton
{
    use SingletonTrait;

    /**
     * @var \SyMessageHandler\ConsumerContainer
     */
    private $consumerContainer = null;
    /**
     * @var \SyMessageHandler\ProducerContainer
     */
    private $producerContainer = null;

    private function __construct()
    {
        $this->consumerContainer = new ConsumerContainer();
        $this->producerContainer = new ProducerContainer();
    }

    /**
     * @return \DesignPatterns\Singletons\MessageHandlerSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 添加消息数据
     * @param int $handlerType 处理类型
     * @param array $msgData 消息数据
     * @param string $queueType 消息队列类型
     * @return array 添加结果
     * @throws \AMQPChannelException
     * @throws \AMQPConnectionException
     * @throws \AMQPExchangeException
     */
    public function addMsgData(int $handlerType, array $msgData, string $queueType) : array
    {
        $obj = $this->producerContainer->getObj($handlerType);
        if (is_null($obj)) {
            Log::info('handler_type: ' . $handlerType . ' error: 处理类型不支持');
            return [];
        }

        $checkRes = $obj->checkMsgData($msgData);
        if (strlen($checkRes) > 0) {
            Log::info('handler_type: ' . $handlerType . ' error: ' . $checkRes);
            return [];
        }

        $trueData = $obj->getMsgData();
        if ($queueType == Project::MESSAGE_QUEUE_TYPE_REDIS) {
            $redisKey = Project::REDIS_PREFIX_MESSAGE_HANDLER_TOPIC . Project::MESSAGE_QUEUE_TOPIC_MSG_HANDLER;
            CacheSimpleFactory::getRedisInstance()->rPush($redisKey, Tool::jsonEncode($trueData, JSON_UNESCAPED_UNICODE));
        } elseif ($queueType == Project::MESSAGE_QUEUE_TYPE_RABBIT) {
            $rabbitProducer = MessageQueueSingleton::getInstance()->getRabbitProducer(Project::MESSAGE_QUEUE_TAG_RABBIT_MESSAGE_HANDLER);
            $rabbitProducer->sendTopicData(Project::MESSAGE_QUEUE_TOPIC_MSG_HANDLER, [
                0 => $trueData,
            ]);
        }

        return $trueData;
    }

    /**
     * 获取消息数据
     * @param string $queueType 消息队列类型
     * @return array 空数组表示没有消息数据
     * @throws \AMQPChannelException
     * @throws \AMQPConnectionException
     */
    public function getMsgData(string $queueType) : array
    {
        if ($queueType == Project::MESSAGE_QUEUE_TYPE_REDIS) {
            $redisKey = Project::REDIS_PREFIX_MESSAGE_HANDLER_TOPIC . Project::MESSAGE_QUEUE_TOPIC_MSG_HANDLER;
            $redisData = CacheSimpleFactory::getRedisInstance()->lPop($redisKey);
            $msgData = is_string($redisData) ? Tool::jsonDecode($redisData) : [];
        } elseif ($queueType == Project::MESSAGE_QUEUE_TYPE_RABBIT) {
            $rabbitConsumer = MessageQueueSingleton::getInstance()->getRabbitConsumer(Project::MESSAGE_QUEUE_TAG_RABBIT_MESSAGE_HANDLER);
            $message = $rabbitConsumer->getQueue()->get();
            if (empty($message)) {
                $msgData = [];
            } else {
                $msgData = Tool::jsonDecode($message->getBody());
                $rabbitConsumer->getQueue()->ack($message->getDeliveryTag());
            }
        }

        return $msgData;
    }

    /**
     * 调用消息
     * @param array $msgData 消息数据
     * @return array
     * @throws \SyException\MessageHandler\MessageHandlerException
     */
    public function invokeMsg(array $msgData) : array
    {
        $handlerType = $msgData['handler_type'] ?? 0;
        $obj = $this->consumerContainer->getObj($handlerType);
        if (is_null($obj)) {
            throw new MessageHandlerException('处理类型不支持', ErrorCode::MESSAGE_HANDLER_INVOKE_ERROR);
        }

        return $obj->handleMsgData($msgData);
    }
}
