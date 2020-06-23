<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-16
 * Time: 下午2:25
 */
namespace SyMessageQueue\Redis;

use SyConstant\ErrorCode;
use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use SyException\MessageQueue\MessageQueueException;
use SyMessageQueue\ConsumerBase;
use SyTool\Tool;

class Producer
{
    /**
     * @var \SyMessageQueue\Redis\Producer
     */
    private static $instance = null;
    /**
     * 管理缓存键名
     * @var string
     */
    private $keyManager = '';

    private function __construct()
    {
        $this->keyManager = Project::REDIS_PREFIX_MESSAGE_QUEUE . 'manager';
    }

    private function __clone()
    {
    }

    /**
     * @return \SyMessageQueue\Redis\Producer
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 添加消费者
     * @param \SyMessageQueue\ConsumerBase $consumer 消费者对象
     * @return bool
     * @throws \SyException\MessageQueue\MessageQueueException
     */
    public function addConsumer(ConsumerBase $consumer)
    {
        if ($consumer->getMqType() != Project::MESSAGE_QUEUE_TYPE_REDIS) {
            throw new MessageQueueException('消息队列类型必须是redis', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
        }

        $topic = $consumer->getTopic();
        $cacheData = [
            'unique_key' => $this->keyManager,
            $topic => '\\' . get_class($consumer),
        ];
        if (!CacheSimpleFactory::getRedisInstance()->hMset($this->keyManager, $cacheData)) {
            throw new MessageQueueException('添加主题失败', ErrorCode::MESSAGE_QUEUE_TOPIC_ERROR);
        }

        return true;
    }

    /**
     * 删除消费者
     * @param \SyMessageQueue\ConsumerBase $consumer
     * @return int
     * @throws \SyException\MessageQueue\MessageQueueException
     */
    public function deleteConsumer(ConsumerBase $consumer)
    {
        if ($consumer->getMqType() != Project::MESSAGE_QUEUE_TYPE_REDIS) {
            throw new MessageQueueException('消息队列类型必须是redis', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
        }

        return CacheSimpleFactory::getRedisInstance()->hDel($this->keyManager, $consumer->getTopic());
    }

    /**
     * 添加主题数据
     * @param string $topic
     * @param array $data
     */
    public function addTopicData(string $topic, array $data)
    {
        $redisKey = Project::REDIS_PREFIX_MESSAGE_QUEUE . $topic;
        foreach ($data as $eData) {
            CacheSimpleFactory::getRedisInstance()->rPush($redisKey, Tool::jsonEncode($eData, JSON_UNESCAPED_UNICODE));
        }
    }
}
