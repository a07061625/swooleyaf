<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/23 0023
 * Time: 18:10
 */
namespace MessageQueue\Consumer\Kafka;

use SyConstant\Project;
use SyLog\Log;
use SyMessageQueue\ConsumerBase;

class Test extends ConsumerBase
{
    public function __construct()
    {
        parent::__construct();
        $this->setMqTypeAndTopic(Project::MESSAGE_QUEUE_TYPE_KAFKA, Project::MESSAGE_QUEUE_TOPIC_TEST);
    }

    public function handleMessage(array $data)
    {
        Log::info('kafka msg:' . print_r($data, true));
    }
}
