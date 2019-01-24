<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/23 0023
 * Time: 17:31
 */
namespace MessageQueue\Consumer;

use Constant\Project;
use MessageQueue\Consumer\Kafka\Test;
use Tool\BaseContainer;

class KafkaConsumerContainer extends BaseContainer {
    public function __construct(){
        $this->registryMap = [
            Project::MESSAGE_QUEUE_TOPIC_TEST,
        ];

        $this->bind(Project::MESSAGE_QUEUE_TOPIC_TEST, function () {
            return new Test();
        });
    }
}