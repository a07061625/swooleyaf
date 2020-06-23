<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:02
 */
namespace SyMessageHandler;

/**
 * Class IProducer
 * @package SyMessageHandler
 */
interface IProducer
{
    /**
     * 检测消息数据
     * @param array $msgData 消息数据
     */
    public function checkMsgData(array $msgData);
}
