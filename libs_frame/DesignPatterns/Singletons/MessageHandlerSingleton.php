<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 21:52
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyException\MessageHandler\MessageHandlerException;
use SyMessageHandler\ConsumerContainer;
use SyMessageHandler\ProducerContainer;
use SyMessageQueue\Redis\Producer;
use SyTrait\SingletonTrait;

/**
 * Class MessageHandlerSingleton
 * @package DesignPatterns\Singletons
 */
class MessageHandlerSingleton
{
    use SingletonTrait;

    /**
     * @var \SyMessageHandler\ConsumerContainer
     */
    private $consumerContainer = null;
    /**
     * @var \SyMessageHandler\ProducerContainer
     */
    private $producerContainer = null;

    private function __construct()
    {
        $this->consumerContainer = new ConsumerContainer();
        $this->producerContainer = new ProducerContainer();
    }

    /**
     * @return \DesignPatterns\Singletons\MessageHandlerSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 添加消息数据
     * @param int $handlerType 处理类型
     * @param array $msgData 消息数据
     * @throws \SyException\MessageHandler\MessageHandlerException
     */
    public function addMessageData(int $handlerType, array $msgData)
    {
        $obj = $this->producerContainer->getObj($handlerType);
        if (is_null($obj)) {
            throw new MessageHandlerException('处理类型不支持', ErrorCode::MESSAGE_HANDLER_PARAM_ERROR);
        }

        $obj->checkMsgData($msgData);
        $trueData = $obj->getMsgData();
        Producer::getInstance()->addTopicData($obj->getQueueTag(), [
            0 => $trueData,
        ]);
    }

    /**
     * 调用消息
     * @param array $msgData 消息数据
     * @return array
     * @throws \SyException\MessageHandler\MessageHandlerException
     */
    public function invokeMsg(array $msgData) : array
    {
        $handlerType = $msgData['handler_type'] ?? 0;
        $obj = $this->consumerContainer->getObj($handlerType);
        if (is_null($obj)) {
            throw new MessageHandlerException('处理类型不支持', ErrorCode::MESSAGE_HANDLER_INVOKE_ERROR);
        }

        return $obj->handleMsgData($msgData);
    }
}
