<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class MiniMessageCustom
 * @package SyMessageHandler\Producers\Wx
 */
class MiniMessageCustom extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_MINI_MESSAGE_CUSTOM);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData)
    {
        // TODO: Implement checkMsgData() method.
    }

    public function getMsgData() : array
    {
        return $this->msgData;
    }
}
