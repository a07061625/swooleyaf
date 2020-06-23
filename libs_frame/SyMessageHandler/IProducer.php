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
     * @return string 检测结果,空字符串表示数据合法,否则为数据错误提示信息
     */
    public function checkMsgData(array $msgData) : string;
}
