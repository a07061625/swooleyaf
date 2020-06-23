<?php
/**
 * 消息生产基类
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 12:38
 */
namespace SyMessageHandler;

use SyConstant\Project;
use SyTool\Tool;

/**
 * Class ProducerBase
 * @package SyMessageHandler
 */
abstract class ProducerBase extends HandlerBase
{
    /**
     * 消息主题,数字和字母组成
     * @var string
     */
    private $msgTopic = '';
    /**
     * 消息数据
     * @var array
     */
    private $msgData = [];

    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
        $this->msgTopic = Project::$messageHandlerQueues[$handlerType];
        $this->msgData = [
            'msg_id' => Tool::createNonceStr(8, 'numlower') . Tool::getNowTime(),
            'handler_type' => $handlerType,
            'data' => []
        ];
    }

    /**
     * @return string
     */
    public function getMsgTopic() : string
    {
        return $this->msgTopic;
    }

    /**
     * @return array
     */
    public function getMsgData() : array
    {
        return $this->msgData;
    }
}
