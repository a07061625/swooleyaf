<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/15 0015
 * Time: 16:02
 */
namespace Helper;

use SyMessageQueue\ConsumerBase;
use SyMessageQueue\Redis\Producer;
use SyTool\Tool;

class MessageQueueRedis
{
    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function handleOption()
    {
        $action = Tool::getClientOption('-action', false, '');
        $className = Tool::getClientOption('-classname', false, '');
        switch ($action) {
            case 'add':
                $class = new $className();
                if ($class instanceof ConsumerBase) {
                    Producer::getInstance()->addConsumer($class);
                } else {
                    print_r('类名不合法' . PHP_EOL);
                }
                break;
            case 'delete':
                $class = new $className();
                if ($class instanceof ConsumerBase) {
                    Producer::getInstance()->deleteConsumer($class);
                } else {
                    print_r('类名不合法' . PHP_EOL);
                }
                break;
            default:
                $this->help();
        }
    }

    private function help()
    {
        print_r('redis帮助信息' . PHP_EOL);
        print_r('-action 操作类型类型: add delete' . PHP_EOL);
        print_r('-classname 消费者类名,从\\开始' . PHP_EOL);
    }
}
