<?php
require_once __DIR__ . '/helper_load.php';

define('SY_MODULE', SY_PROJECT . 'task');
define('SY_SERVER_IP', (string)SyTool\Tool::getConfig('syserver.base.server.host'));
set_exception_handler('\SyError\ErrorHandler::handleException');
set_error_handler('\SyError\ErrorHandler::handleError');
SyLog\Log::setPath(SY_LOG_PATH);

/**
 * 消息队列消费
 */

function syMessageQueueHelp()
{
    print_r('帮助信息' . PHP_EOL);
    print_r('-t 消息队列类型: redis kafka' . PHP_EOL);
}

function handleKafkaMessage()
{
    global $kafka;
    $kafka->refresh();
    $kafka->handleMessage();
}

$type = SyTool\Tool::getClientOption('-t');
switch ($type) {
    case 'redis':
        $redis = new \Helper\MessageQueueRedis();
        $redis->handleOption();
        break;
    case 'kafka':
        $kafka = new \Helper\MessageQueueKafka();
        pcntl_signal(SIGALRM, 'handleKafkaMessage');

        while (true) {
            pcntl_alarm(10);
            pcntl_signal_dispatch();
            sleep(10);
        }
        break;
    default:
        syMessageQueueHelp();
}
