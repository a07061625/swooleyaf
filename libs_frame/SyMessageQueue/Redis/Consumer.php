<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-16
 * Time: 下午1:46
 */
namespace SyMessageQueue\Redis;

use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\MessageQueueSingleton;
use SyLog\Log;
use SyTool\Tool;

class Consumer
{
    /**
     * @var \SyMessageQueue\Redis\Consumer
     */
    private static $instance = null;
    /**
     * 管理缓存键名
     * @var string
     */
    private $keyManager = '';
    /**
     * @var int
     */
    private $msgMaxIndex = 0;
    /**
     * @var int
     */
    private $resetTimes = 0;
    /**
     * 消费者列表
     * @var array
     */
    private $consumers = [];
    /**
     * 主题列表
     * @var array
     */
    private $topics = [];
    /**
     * 延续次数
     * @var int
     */
    private $continueTimes = 0;

    private function __construct()
    {
        $this->keyManager = Project::REDIS_PREFIX_MESSAGE_QUEUE . 'manager';
        $config = MessageQueueSingleton::getInstance()->getRedisConfig();
        $this->msgMaxIndex = $config->getConsumerBatchMsgNum() - 1;
        $this->resetTimes = $config->getConsumerBatchResetTimes();
        $this->init();
    }

    private function __clone()
    {
    }

    /**
     * @return \SyMessageQueue\Redis\Consumer
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function handleData()
    {
        $this->continueTimes++;
        if ($this->continueTimes >= $this->resetTimes) {
            $this->init();
        }

        foreach ($this->topics as $topic => $className) {
            $consumer = $this->getConsumer($topic);
            if (is_null($consumer)) {
                continue;
            }

            $redisKey = Project::REDIS_PREFIX_MESSAGE_QUEUE . $topic;
            $dataList = CacheSimpleFactory::getRedisInstance()->lRange($redisKey, 0, $this->msgMaxIndex);
            $dataNum = count($dataList);
            if ($dataNum > 0) {
                CacheSimpleFactory::getRedisInstance()->lTrim($redisKey, $dataNum, -1);
                foreach ($dataList as $eData) {
                    $consumerData = Tool::jsonDecode($eData);
                    if (is_array($consumerData)) {
                        try {
                            $consumer->handleMessage($consumerData);
                        } catch (\Exception $e) {
                            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
                        }
                    } else {
                        Log::error('主题为' . $topic . '的数据消费出错,消费数据为' . $eData);
                    }
                }
            }
        }
    }

    private function init()
    {
        $this->continueTimes = 0;
        $this->topics = [];
        $this->consumers = [];
        $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll($this->keyManager);
        if (isset($cacheData['unique_key']) && ($cacheData['unique_key'] == $this->keyManager)) {
            unset($cacheData['unique_key']);
            $this->topics = $cacheData;
        }
    }

    /**
     * 获取消费者
     * @param string $topic
     * @return \SyMessageQueue\ConsumerBase|null
     */
    private function getConsumer(string $topic)
    {
        if (isset($this->consumers[$topic])) {
            return $this->consumers[$topic];
        }
        if (isset($this->topics[$topic])) {
            $className = $this->topics[$topic];
            $class = new $className();
            $this->consumers[$topic] = $class;
            return $class;
        }
    }
}
