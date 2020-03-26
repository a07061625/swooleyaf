<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-16
 * Time: 下午2:59
 */
namespace SyMessageQueue\Kafka;

use DesignPatterns\Singletons\MessageQueueSingleton;
use SyTool\Tool;

class Producer
{
    /**
     * @var \SyMessageQueue\Kafka\Producer
     */
    private static $instance = null;
    /**
     * @var null|\RdKafka\Producer
     */
    private $obj = null;

    private function __construct()
    {
        $this->obj = MessageQueueSingleton::getInstance()->getKafkaProducer();
    }

    private function __clone()
    {
    }

    /**
     * @return \SyMessageQueue\Kafka\Producer
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 添加主题数据
     * @param string $topic 主题名称
     * @param array $data 数据
     */
    public function addTopicData(string $topic, array $data)
    {
        $topicName = SY_ENV . SY_PROJECT . $topic;
        $topicObj = $this->obj->newTopic($topicName);
        foreach ($data as $eData) {
            $topicObj->produce(RD_KAFKA_PARTITION_UA, 0, Tool::jsonEncode($eData, JSON_UNESCAPED_UNICODE));
            $this->obj->poll(0);
        }

        while ($this->obj->getOutQLen() > 0) {
            $this->obj->poll(50);
        }
    }
}
