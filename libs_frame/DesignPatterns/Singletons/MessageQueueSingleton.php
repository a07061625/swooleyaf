<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-16
 * Time: 下午1:27
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyException\MessageQueue\MessageQueueException;
use RdKafka\Conf;
use RdKafka\KafkaConsumer;
use RdKafka\Producer;
use RdKafka\TopicConf;
use SyMessageQueue\ConfigRedis;
use SyMessageQueue\Rabbit\Consumer as RabbitConsumer;
use SyMessageQueue\Rabbit\Producer as RabbitProducer;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class MessageQueueSingleton
{
    use SingletonTrait;
    /**
     * @var \SyMessageQueue\ConfigRedis
     */
    private $redisConfig = null;
    /**
     * @var \RdKafka\Producer
     */
    private $kafkaProducer = null;
    /**
     * @var \RdKafka\KafkaConsumer
     */
    private $kafkaConsumer = null;
    /**
     * @var array
     */
    private $rabbitConsumers = [];
    /**
     * @var array
     */
    private $rabbitProducers = [];

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\MessageQueueSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyMessageQueue\ConfigRedis
     * @throws \SyException\MessageQueue\MessageQueueException
     */
    public function getRedisConfig()
    {
        if (is_null($this->redisConfig)) {
            $configs = Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.redis');
            $redisConfig = new ConfigRedis();
            $redisConfig->setConsumerBatchMsgNum((int)Tool::getArrayVal($configs, 'consumer.batch.msg.num', 100, true));
            $redisConfig->setConsumerBatchResetTimes((int)Tool::getArrayVal($configs, 'consumer.batch.reset.times', 100, true));
            $this->redisConfig = $redisConfig;
        }

        return $this->redisConfig;
    }

    /**
     * @return \RdKafka\Producer
     * @throws \SyException\MessageQueue\MessageQueueException
     */
    public function getKafkaProducer()
    {
        if (is_null($this->kafkaProducer)) {
            $configs = Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.kafka');
            $brokers = trim(Tool::getArrayVal($configs, 'common.metadata.broker.list', '', true));
            if (strlen($brokers) == 0) {
                throw new MessageQueueException('broker不能为空', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
            }

            $producerConf = new Conf();
            $producerConf->set('request.required.acks', (int)Tool::getArrayVal($configs, 'producer.request.required.acks', 1, true));
            $producerConf->set('request.timeout.ms', (int)Tool::getArrayVal($configs, 'producer.request.timeout.ms', 3000, true));
            $this->kafkaProducer = new Producer($producerConf);
            $this->kafkaProducer->setLogLevel(LOG_DEBUG);
            $this->kafkaProducer->addBrokers($brokers);
        }

        return $this->kafkaProducer;
    }

    /**
     * @return \RdKafka\KafkaConsumer
     * @throws \SyException\MessageQueue\MessageQueueException
     */
    public function getKafkaConsumer()
    {
        if (is_null($this->kafkaConsumer)) {
            $configs = Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.kafka');
            $brokers = trim(Tool::getArrayVal($configs, 'common.metadata.broker.list', '', true));
            if (strlen($brokers) == 0) {
                throw new MessageQueueException('broker不能为空', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
            }

            $groupId = SY_ENV . SY_PROJECT . Tool::createNonceStr(4) . time();
            $consumerTopicConf = new TopicConf();
            $consumerTopicConf->set('auto.offset.reset', (string)Tool::getArrayVal($configs, 'consumer.auto.offset.reset', 'earliest', true));
            $consumerTopicConf->set('offset.store.sync.interval.ms', (int)Tool::getArrayVal($configs, 'consumer.offset.store.sync.interval.ms', 0, true));
            $consumerConf = new Conf();
            $consumerConf->set('group.id', $groupId);
            $consumerConf->set('metadata.broker.list', $brokers);
            $consumerConf->set('enable.auto.commit', true);
            $consumerConf->set('auto.commit.interval.ms', 0);
            $consumerConf->set('enable.auto.offset.store', true);
            $consumerConf->set('offset.store.method', 'broker');
            $consumerConf->set('fetch.wait.max.ms', (int)Tool::getArrayVal($configs, 'consumer.fetch.wait.max.ms', 2000, true));
            $consumerConf->setDefaultTopicConf($consumerTopicConf);
            $consumerConf->setRebalanceCb(function (KafkaConsumer $kafka, $err, array $partitions = null) {
                switch ($err) {
                    case RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS:
                        $kafka->assign($partitions);
                        break;
                    case RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS:
                        $kafka->assign(null);
                        break;
                    default:
                        throw new MessageQueueException('kafka消费出错', ErrorCode::MESSAGE_QUEUE_KAFKA_CONSUMER_ERROR);
                }
            });
            $this->kafkaConsumer = new KafkaConsumer($consumerConf);
            $this->kafkaConsumer->subscribe([
                '^' . SY_ENV . SY_PROJECT . '[0-9a-zA-Z]+',
            ]);
        }

        return $this->kafkaConsumer;
    }

    /**
     * @param string $tag
     * @return \SyMessageQueue\Rabbit\Producer
     */
    public function getRabbitProducer(string $tag) : RabbitProducer
    {
        if(!isset($this->rabbitProducers[$tag])){
            $this->rabbitProducers[$tag] = new RabbitProducer($tag);
        }

        return $this->rabbitProducers[$tag];
    }

    public function removeRabbitProducer(string $tag)
    {
        unset($this->rabbitProducers[$tag]);
    }

    /**
     * @return array
     */
    public function getRabbitProducers()
    {
        return $this->rabbitProducers;
    }

    /**
     * @param string $tag
     * @return \SyMessageQueue\Rabbit\Consumer
     */
    public function getRabbitConsumer(string $tag) : RabbitConsumer
    {
        if(!isset($this->rabbitConsumers[$tag])){
            $this->rabbitConsumers[$tag] = new RabbitConsumer($tag);
        }

        return $this->rabbitConsumers[$tag];
    }

    public function removeRabbitConsumer(string $tag)
    {
        unset($this->rabbitConsumers[$tag]);
    }

    /**
     * @return array
     */
    public function getRabbitConsumers()
    {
        return $this->rabbitConsumers;
    }
}
