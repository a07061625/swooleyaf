<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:01
 */
namespace SyMessageHandler;

/**
 * Class IConsumer
 * @package SyMessageHandler
 */
interface IConsumer
{
    /**
     * 处理消息数据
     * @param array $msgData 消息数据
     * @return array
     */
    public function handleMsgData(array $msgData) : array;
}
