<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/23 0023
 * Time: 17:31
 */
namespace MessageQueue\Consumer;

use MessageQueue\Consumer\Rabbit\Test;
use SyConstant\Project;
use SyTool\BaseContainer;

class RabbitConsumerContainer extends BaseContainer
{
    public function __construct()
    {
        $this->registryMap = [
            Project::MESSAGE_QUEUE_TOPIC_TEST,
        ];

        $this->bind(Project::MESSAGE_QUEUE_TOPIC_TEST, function () {
            return new Test();
        });
    }
}
