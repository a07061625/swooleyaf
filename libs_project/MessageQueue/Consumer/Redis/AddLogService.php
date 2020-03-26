<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-23
 * Time: 下午10:05
 */
namespace MessageQueue\Consumer\Redis;

use SyConstant\Project;
use SyLog\Log;
use SyMessageQueue\ConsumerBase;
use SyTool\Tool;

class AddLogService extends ConsumerBase
{
    public function __construct()
    {
        parent::__construct();
        $this->setMqTypeAndTopic(Project::MESSAGE_QUEUE_TYPE_REDIS, Project::MESSAGE_QUEUE_TOPIC_ADD_LOG);
    }

    private function __clone()
    {
    }

    public function handleMessage(array $data)
    {
        Log::info('mqdata:' . Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE));
    }
}
