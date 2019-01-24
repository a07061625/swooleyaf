<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/9/9 0009
 * Time: 11:01
 */
namespace MessageQueue\Consumer\Redis;

use Constant\Project;
use Constant\Server;
use Log\Log;
use SyMessageQueue\ConsumerBase;

class ReqHealthCheckService extends ConsumerBase {
    public function __construct() {
        parent::__construct();
        $this->setMqTypeAndTopic(Project::MESSAGE_QUEUE_TYPE_REDIS, Project::MESSAGE_QUEUE_TOPIC_REQ_HEALTH_CHECK);
    }

    private function __clone() {
    }

    public function handleMessage(array $data) {
        Log::warn('module:' . $data['module'] . ',uri:' . $data['uri'] . ' handle req cost more than ' . Server::SERVER_TIME_REQ_HEALTH_MIN . ' ms');
    }
}