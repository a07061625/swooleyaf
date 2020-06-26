<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/18 0018
 * Time: 18:32
 */
namespace SyMessageQueue\Rabbit;

use SyTool\Tool;

class Producer extends Basic
{
    public function __construct(string $tag)
    {
        parent::__construct($tag, '1');
    }

    public function __destruct()
    {
        $this->destroy();
    }

    private function __clone()
    {
    }

    /**
     * 发送主题数据
     * @param string $topic
     * @param array $data
     * @throws \AMQPChannelException
     * @throws \AMQPConnectionException
     * @throws \AMQPExchangeException
     */
    public function sendTopicData(string $topic, array $data)
    {
        $trueTopic = $this->tag . '.' . $topic;
        foreach ($data as $eData) {
            $this->exchange->publish(Tool::jsonEncode($eData, JSON_UNESCAPED_UNICODE), $trueTopic, AMQP_MANDATORY, [
                'delivery_mode' => 2,
            ]);
        }
    }
}
