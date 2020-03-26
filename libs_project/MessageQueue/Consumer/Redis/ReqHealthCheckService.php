<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/9/9 0009
 * Time: 11:01
 */
namespace MessageQueue\Consumer\Redis;

use SyConstant\Project;
use SyLog\Log;
use SyMessageQueue\ConsumerBase;

class ReqHealthCheckService extends ConsumerBase
{
    public function __construct()
    {
        parent::__construct();
        $this->setMqTypeAndTopic(Project::MESSAGE_QUEUE_TYPE_REDIS, Project::MESSAGE_QUEUE_TOPIC_REQ_HEALTH_CHECK);
    }

    private function __clone()
    {
    }

    public function handleMessage(array $data)
    {
        Log::warn('module:' . $data['module'] . ',uri:' . $data['uri'] . ' handle req cost time large than limit');
    }
}
