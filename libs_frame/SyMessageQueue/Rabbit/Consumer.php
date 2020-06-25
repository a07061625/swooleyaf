<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/18 0018
 * Time: 18:32
 */
namespace SyMessageQueue\Rabbit;

class Consumer extends Basic
{
    public function __construct(string $topicPrefix)
    {
        parent::__construct($topicPrefix, '2');
    }

    public function __destruct()
    {
        $this->destroy();
    }

    private function __clone()
    {
    }
}
