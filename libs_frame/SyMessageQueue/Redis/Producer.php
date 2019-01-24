<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-16
 * Time: 下午2:25
 */
namespace SyMessageQueue\Redis;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\MessageQueue\MessageQueueException;
use SyMessageQueue\ConsumerBase;
use Tool\Tool;

class Producer {
    /**
     * @var \SyMessageQueue\Redis\Producer
     */
    private static $instance = null;
    /**
     * 管理缓存键名
     * @var string
     */
    private $keyManager = '';

    private function __construct(){
        $this->keyManager = Project::REDIS_PREFIX_MESSAGE_QUEUE . 'manager';
    }

    private function __clone(){
    }

    /**
     * @return \SyMessageQueue\Redis\Producer
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 添加消费者
     * @param \SyMessageQueue\ConsumerBase $consumer 消费者对象
     * @return bool
     * @throws \Exception\MessageQueue\MessageQueueException
     */
    public function addConsumer(ConsumerBase $consumer) {
        if($consumer->getMqType() != Project::MESSAGE_QUEUE_TYPE_REDIS){
            throw new MessageQueueException('消息队列类型必须是redis', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
        }

        $topic = $consumer->getTopic();
        $cacheData = [
            'unique_key' => $this->keyManager,
            $topic => '\\' . get_class($consumer),
        ];
        if(!CacheSimpleFactory::getRedisInstance()->hMset($this->keyManager, $cacheData)){
            throw new MessageQueueException('添加主题失败', ErrorCode::MESSAGE_QUEUE_TOPIC_ERROR);
        }

        return true;
    }

    /**
     * 删除消费者
     * @param \SyMessageQueue\ConsumerBase $consumer
     * @return int
     * @throws \Exception\MessageQueue\MessageQueueException
     */
    public function deleteConsumer(ConsumerBase $consumer) {
        if($consumer->getMqType() != Project::MESSAGE_QUEUE_TYPE_REDIS){
            throw new MessageQueueException('消息队列类型必须是redis', ErrorCode::MESSAGE_QUEUE_PARAM_ERROR);
        }

        return CacheSimpleFactory::getRedisInstance()->hDel($this->keyManager, $consumer->getTopic());
    }

    /**
     * 添加主题数据
     * @param string $topic
     * @param array $data
     */
    public function addTopicData(string $topic,array $data) {
        $topicName = SY_ENV . SY_PROJECT . $topic;
        foreach ($data as $eData) {
            CacheSimpleFactory::getRedisInstance()->rPush(Project::REDIS_PREFIX_MESSAGE_QUEUE . $topicName, Tool::jsonEncode($eData, JSON_UNESCAPED_UNICODE));
        }
    }
}