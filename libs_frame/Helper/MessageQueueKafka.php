<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/30 0030
 * Time: 17:24
 */
namespace Helper;

use SyConstant\Project;
use DesignPatterns\Singletons\MessageQueueSingleton;
use DesignPatterns\Singletons\MysqlSingleton;
use DesignPatterns\Singletons\RedisSingleton;
use SyLog\Log;
use MessageQueue\Consumer\KafkaConsumerContainer;
use RdKafka\Message;
use SyTool\Tool;

class MessageQueueKafka
{
    /**
     * @var \MessageQueue\Consumer\KafkaConsumerContainer
     */
    private $consumerContainer = null;
    /**
     * @var int
     */
    private $offsetExpireTime = 0;
    /**
     * @var int
     */
    private $messageHandleMaxNum = 0;

    public function __construct()
    {
        $this->consumerContainer = new KafkaConsumerContainer();
        $this->offsetExpireTime = (int)Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.kafka.common.offset.expire');
        $this->messageHandleMaxNum = (int)Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.kafka.common.message.handle.max');
    }

    private function __clone()
    {
    }

    public function refresh()
    {
        RedisSingleton::getInstance()->close();
        if (SY_DATABASE) {
            MysqlSingleton::getInstance()->reConnect();
        }
    }

    public function handleMessage()
    {
        $totalNum = $this->messageHandleMaxNum;

        while ($totalNum > 0) {
            $message = MessageQueueSingleton::getInstance()->getKafkaConsumer()->consume(31536000000);
            $totalNum--;

            $this->handle($message, $totalNum);
        }
    }

    private function handle(Message $message, int &$totalNum)
    {
        switch ($message->err) {
            case RD_KAFKA_RESP_ERR_NO_ERROR:
                $consumer = $this->consumerContainer->getObj($message->topic_name);
                if (is_null($consumer)) {
                    break;
                }

                $redisKey = Project::REDIS_PREFIX_MESSAGE_KAFKA_OFFSET . $message->topic_name . '_' . $message->partition . '_' . $message->offset;
                $cacheData = RedisSingleton::getInstance()->getConn()->get($redisKey);
                if ($cacheData !== false) {
                    unset($consumer);
                    break;
                }

                $msgData = Tool::jsonDecode($message->payload);
                try {
                    $consumer->handleMessage($msgData);
                } catch (\Exception $e) {
                    Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
                } finally {
                    unset($consumer);
                    MessageQueueSingleton::getInstance()->getKafkaConsumer()->commit($message);
                    RedisSingleton::getInstance()->getConn()->set($redisKey, '1', $this->offsetExpireTime);
                }

                break;
            case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                $totalNum = 0;
                break;
            case RD_KAFKA_RESP_ERR__TIMED_OUT:
                Log::error('kafka consumer handle time out, msg:' . $message->errstr());
                $totalNum = 0;
                break;
            default:
                Log::error($message->errstr(), $message->err);
                break;
        }
    }
}
